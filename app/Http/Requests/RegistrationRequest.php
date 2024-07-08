<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required_without:phone_number|string|lowercase|email|max:255',
            'phone_number' => 'required_without:email|nullable|regex:/^\+251[79][0-9]{8}$/|max:13',
            'password' => ['required_without:email', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'type' => 'required|string|in:admin,buyer,seller',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->route('register.socialite')
                ->withErrors($validator)
                ->withInput()
        );
    }
}
