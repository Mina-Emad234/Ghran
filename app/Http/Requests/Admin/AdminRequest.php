<?php

namespace App\Http\Requests\Admin;

use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "name"=>"required",
            "email"=>"required|email|unique:admins,email,".$this->id,
            "password"=>"required_without:id|nullable|confirmed|min:8",
            "role_id"=>"required|exists:roles,id",
            'g-recaptcha-response' => 'required'

        ];
    }
        public function messages()
    {
        return [
            "required"=>"إملأ الحقل",
            "required_without"=>"إملأ الحقل",
            "email"=>"بريد إلكتروني غير صحيح",
            "unique"=>"البريد الإلكتروني موجود من قبل",
            "confirmed"=>"كلمة المرور غير متطابقة",
            "min"=>"يجب ألا تقل كلمة الحروف عن 8 أحرف",
            'exists'=>'هذه الصلاحية غير موجود',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }

}
