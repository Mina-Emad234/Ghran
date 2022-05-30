<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'name'=>'required|max:50',
            'email'=>'required|max:50|email|unique:list_mails,email',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'unique'=>'البريد الالكتروني موجود بالفعل من فضلك ضع بريد الالكتروني جديد',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @'
        ];
    }
}
