<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginApiRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'regnum' => ['required', 'regex:/^[А-ЯЁҮӨа-яёүө]{2}[0-9]{8}$/u'],
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            // 'image' => 'required|string',
            // 'aimagCityName' => 'required|string',
            // 'soumDistrictName' => 'required|string',
            // 'bagKhorooName' => 'required|string',
            // 'passportAddress' => 'required|string',
            // 'gender' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'regnum.required' => 'Registration number is required.',
            'regnum.regex' => 'Registration number must start with 2 Cyrillic letters followed by 8 digits, with a total length of 10 characters.',
            // Add other custom validation messages as needed
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}