<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintStoreRequest extends FormRequest
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
            // 'firstname' => 'required',
            // 'lastname' => 'required',
            // 'registerNumber' => 'required',
            'phone' => 'required',
            // 'email' => 'required|email',
            // 'country' => 'required',
            // 'district' => 'required',
            // 'khoroo' => 'required',
            // 'addressDetail' => 'required',
            'expire_date' => 'required',
            'complaint' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'firstname.required' => 'Заавал бөглөнө үү!',
            // 'lastname.required' => 'Заавал бөглөнө үү',
            // 'registerNumber.required' => 'Заавал бөглөнө үү!',
            'phone.required' => 'Заавал бөглөнө үү!',
            'expire_date.required' => 'Заавал бөглөнө үү!',
            // 'email.required' => 'Заавал бөглөнө үү!',
            // 'country.required' => 'Заавал бөглөнө үү!',
            // 'district.required' => 'Заавал бөглөнө үү!',
            // 'khoroo.required' => 'Заавал бөглөнө үү!',
            // 'addressDetail.required' => 'Заавал бөглөнө үү!',
            'complaint.required' => 'Заавал бөглөнө үү!',
        ];
    }
}
