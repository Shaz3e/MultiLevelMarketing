<?php

use App\Models\AppSetting;
use App\Models\Currency;
use App\Models\ReferralTree;
use App\Models\UserWallet;
use Carbon\Carbon;

function DiligentCreators($appSettingName)
{
	return AppSetting::where('name', $appSettingName)->value('value');
}

function currency($currencyId, $fields = ['id', 'name', 'symbol'])
{
	$currency = Currency::find($currencyId);
	return $currency->getData($fields);
}

function getAllTimeZonesSelectBox($selectedValue)
{
	echo '<select name="site_timezone" class="form-control select2" id="site_timezone" required="required">';
	echo '<option value="">-- Select Time Zone --</option>';
	$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
	foreach ($tzlist as $value) {
		$selected = ($value === $selectedValue) ? 'selected="selected"' : '';
		echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
	}
	echo '</select>';
}

function calcTime($startTime, $endTime)
{
	$start_time = Carbon::parse($startTime);
	$complete_time = Carbon::parse($endTime);

	$time_diff = $complete_time->diff($start_time);

	if ($time_diff->days > 0) {
		$days = $time_diff->format('%d');
		$hours = $time_diff->format('%h');
		$minutes = $time_diff->format('%i');
		return "$days days $hours hrs $minutes minutes";
	} elseif ($time_diff->hours > 0) {
		$hours = $time_diff->format('%h');
		$minutes = $time_diff->format('%i');
		return "$hours hrs $minutes minutes";
	} else {
		$minutes = $time_diff->format('%i');
		return "$minutes minutes";
	}
}

function currencyFormat($value, $decimals = 2)
{
	return number_format($value, $decimals);
}



/**
 * Update Level
 */
function startLevel()
{
	// Without Referral Users
	$dataSet = ReferralTree::all();
	foreach ($dataSet as $data) {
		updateLevel($data->user_id);
	}
}


function updateLevel($parentID)
{
	// Level 1 as direct user
	$level1DataSet = ReferralTree::where('user_id', $parentID)->get();
	foreach ($level1DataSet as $level1Data) {
		$levelId = $level1Data->id;
		ReferralTree::where('id', $levelId)->update([
			'level_1' => $level1Data->parent_id,
		]);
		// Create Wallet
		// UserWallet::create([
		// 	'user_id' => $level1Data->user_id,
		// 	'amount' => DiligentCreators('default_currency') / 12 * 100,
		// 	'points' => 50,
		// ]);

		// Level 2 as level 1
		$level2DataSet = ReferralTree::where('user_id', $level1Data->parent_id)->get();
		foreach ($level2DataSet as $level2Data) {
			ReferralTree::where('id', $levelId)->update([
				'level_2' => $level2Data->parent_id,
			]);
			// Create Wallet
			// UserWallet::create([
			// 	'user_id' => $level1Data->user_id,
			// 	'amount' => DiligentCreators('default_currency') / 10 * 100,
			// 	'points' => 25,
			// ]);

			// Level 3 as level 2
			$level3DataSet = ReferralTree::where('user_id', $level2Data->parent_id)->get();
			foreach ($level3DataSet as $level3Data) {
				ReferralTree::where('id', $levelId)->update([
					'level_3' => $level3Data->parent_id,
				]);
				// Create Wallet
				// UserWallet::create([
				// 	'user_id' => $level1Data->user_id,
				// 	'amount' => DiligentCreators('default_currency') / 8 * 100,
				// 	'points' => 25,
				// ]);

				// Level 4 as level 3
				$level4DataSet = ReferralTree::where('user_id', $level3Data->parent_id)->get();
				foreach ($level4DataSet as $level4Data) {
					ReferralTree::where('id', $levelId)->update([
						'level_4' => $level4Data->parent_id,
					]);
					// Create Wallet
					// UserWallet::create([
					// 	'user_id' => $level1Data->user_id,
					// 	'amount' => DiligentCreators('default_currency') / 7 * 100,
					// 	'points' => 25,
					// ]);
				}
			}
		}
	}
}

function showLevel($levelNo, $parentId)
{
	return ReferralTree::select(
		'referral_trees.*',
		'users.id',
		'users.name',
	)
		->leftJoin('users', 'users.id', 'referral_trees.user_id')
		->where('level_' . $levelNo, $parentId)
		->get();
}
