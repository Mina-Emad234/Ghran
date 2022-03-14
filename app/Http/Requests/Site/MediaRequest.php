<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'identity'=>'required|size:16|unique:media,identity',
            'mobile'=>'required|size:11|starts_with:010,011,012,015|unique:media,mobile',
            'email'=>'required|email|max:50|unique:media,email',
            'course'=>'required|in:المونتـــــــــاج,التصميـــــــــم,التمثيـــــــــل,التصوير الفوتوغرافي,تصويــــر الفيديو,إدارة المواقع الالكترونية',
            'captcha' => 'required|captcha',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'إملأ الخقل',
            'max' => ' الحد الأقصى 50 حرف',
            'email' => 'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'captcha' => 'رمز التحقيق غير صحيح',
            'unique' => 'البريد الالكتروني موجود بالفعل من فضلك ضع بريد الالكتروني جديد',
            'identity.size' => 'يجب أن يتكون رقم الهوية من 16 رقم',
            'numeric' => 'هناك خطأ ما',
            'in' => 'هناك خطأ ما',
            'mobile.size' => 'رقم الجوال غير صالح',
            'starts_with' => 'رقم الجوال غير صالح',
            'mobile.unique' => 'رقم الجوال تم تسجيله من قبل',
            'identity.unique' => 'رقم الهوية تم تسجيله من قبل',

        ];
    }
}
