<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserWallet;

class ReferralService
{
    public function allocateRewards(User $user)
    {
        $referrer = $user->referrer; // Get the direct referrer
        if (!$referrer) {
            return;
        }

        // Level 1: Direct referrer
        $this->addReward($referrer, 12, 50);

        // Level 2: Referrer's referrer
        $referrerLevel1 = $referrer->referrer;
        if ($referrerLevel1) {
            $this->addReward($referrerLevel1, 10, 25);

            // Level 3: Referrer's referrer's referrer
            $referrerLevel2 = $referrerLevel1->referrer;
            if ($referrerLevel2) {
                $this->addReward($referrerLevel2, 8, 25);

                // Level 4: Referrer's referrer's referrer's referrer
                $referrerLevel3 = $referrerLevel2->referrer;
                if ($referrerLevel3) {
                    $this->addReward($referrerLevel3, 7, 25);
                }
            }
        }
    }

    private function addReward(User $user, $percentage, $points)
    {
        // Assuming the base amount to calculate the reward from is $100 (or fetch dynamically)
        $baseAmount = DiligentCreators('default_price');
        $rewardAmount = ($baseAmount * $percentage) / 100;

        // Update user's wallet
        $wallet = UserWallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->increment('reward_amount', $rewardAmount);
        $wallet->increment('points', $points);
    }
}
