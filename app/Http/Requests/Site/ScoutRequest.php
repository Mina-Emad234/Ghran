<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ScoutRequest extends FormRequest
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
            'school'=>'required|max:50',
            'grade'=>'required|max:50',
            'age'=>'required|numeric|between:18,40',
            'mobile'=>'required|size:11|starts_with:010,011,012,015|unique:scouts,mobile',
            'address'=>'required|max:50|string',
            'email'=>'required|email|max:50|unique:scouts,email',
            'interests'=>'required|max:500',
            'parent_name'=>'required|max:50',
            'parent_email'=>'required|max:50|email',
            'parent_mobile'=>'required|size:11|starts_with:010,011,012,015',
            'parent_tel'=>'max:15',
            'image'=>'required|mimes:jpg,gif,jpeg,png|max:4000',
            'parent_job'=>'required|max:50',
            'captcha' => 'required|captcha',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'interests.max'=>' الحد الأقصى 500 حرف',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
            'captcha'=>'رمز التحقيق غير صحيح',
            'unique'=>'البريد الالكتروني موجود بالفعل من فضلك ضع بريد الالكتروني جديد',
            'between'=>'السن يجب أن لا يقل عن 18 عام وان لا يزيد عن 40 عام',
            'size'=>'رقم الجوال غير صالح',
            'starts_with'=>'رقم الجوال غير صالح',
            'mobile.unique'=>'رقم الجوال تم تسجيله من قبل',
            'string'=>' يجب أن يحتوي الحقل على بيانات نصية',
            'parent_tel.max'=>'الحد الأقصى 15 رقم',
            'numeric'=>' يجب أن يحتوي الحقل على بيانات رقمية',

        ];
    }
}
