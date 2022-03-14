<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'key'=>'required|max:100',
            'value'=>'required|max:200'
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'key.max'=>' الحد الأقصى 100 حرف',
            'value.max'=>' الحد الأقصى 200 حرف',
        ];
    }
}
