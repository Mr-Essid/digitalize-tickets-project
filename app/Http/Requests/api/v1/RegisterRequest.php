<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|max:255|min:2|string',
            'lastname' => 'required|max:255|min:2|string',
            'email' => 'required|max:255|min:3|email|unique:clients',
            'wallet' => 'nullable|integer',
            'phoneNumber' => 'required|string|max:8|unique:clients,phone_number',
            'deviceName' => 'required|string|max:255',
            'appId' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
        ];
    }

}
