<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merchant_settings.value.name' => ['required'],
            'merchant_settings.value.email' => ['required', 'email']
        ];
    }

    public function messages()
    {
        return [
            'merchant_settings.value.name.required' => "Please enter merchant name",
            'merchant_settings.value.email.required' => "Please enter merchant email address",
            'merchant_settings.value.email.email' => "Please enter a valid email address",
        ];
    }
}
