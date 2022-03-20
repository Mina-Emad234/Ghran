<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            "email"=>"required|email",
            "password"=>"required",
            'g-recaptcha-response' => 'required'

        ];
    }
    public function messages()
    {
        return [
            "required"=>"الحقل مطلوب من فضلك إملأ الحقل",
            "email"=>"البريد الألكتروني به مشكلة أو قد يكون غير صحيح",
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
