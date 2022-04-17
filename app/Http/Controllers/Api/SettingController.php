<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::firstWhere('key', 'merchant');
    }

    public function update(StoreSettingRequest $request, Setting $setting) {
        $setting->update([
           'value' => [
               'name' => $request->merchant_settings['value']['name'],
               'email' => $request->merchant_settings['value']['email']
           ]
        ]);

        return [
            'message' => 'Merchant setting has been updated successfully'
        ];
    }
}
