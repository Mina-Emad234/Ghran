<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'body'=>'required|max:500',
            'g-recaptcha-response' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'name.max'=>' الحد الأقصى 500 حرف',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',

        ];
    }
}
