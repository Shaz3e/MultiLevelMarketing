<?php

namespace App\Http\Controllers\Admin\AppSetting;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CurrencySettingController extends Controller
{
    public function currency()
    {
        // Check authorize
        Gate::authorize('currency', AppSetting::class);

        return view('admin.app-setting.main');
    }

    public function currencyStore(Request $request)
    {
        // Check authorize
        Gate::authorize('currencyStore', AppSetting::class);

        $rules = [
            'currency_id' => 'required|exists:currencies,id',
            'gst' => 'required|gte:0|lte:100',
            'default_price' => 'required|gte:0|lte:100000000',
        ];

        // Validate the request data based on the rules
        $validated = $request->validate($rules);

        // Loop through each validated field and update or create the settings
        foreach ($validated as $key => $value) {
            AppSetting::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Setting Saved');
    }
}
