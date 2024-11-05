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
            'phone' => 'required',
            'energy_type_id' => 'required',
            'complaint_type_id' => 'required',
            'complaint_type_summary_id' => 'required',
            'complaint' => 'required',
            'files' => 'array|max:5',
            'files.*' => 'file|max:20480|mimes:jpg,jpeg,png,pdf',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Заавал бөглөнө үү!',
            'energy_type_id.required' => 'Заавал бөглөнө үү!',
            'complaint_type_id.required' => 'Заавал бөглөнө үү!',
            'complaint_type_summary_id.required' => 'Заавал бөглөнө үү!',
            'complaint.required' => 'Заавал бөглөнө үү!',
            'files.max' => 'Дээд тал нь 5 файл хавсаргах боломжтой.',
            'files.*.max' => '1 файлын хэмжээ дээд тал нь 20MB хэмжээтэй байна.',
            'files.*.mimes' => 'Зөвхөн JPG, JPEG, PNG, эсвэл PDF өргөтгөлтэй файл хуулах боломжтой',
        ];
    }
}