<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class CourseApplicantRequest extends FormRequest
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
            'city'=>'required|max:50',
            'age'=>'required|numeric|between:18,40',
            'mobile'=>'required|size:11|starts_with:010,011,012,015',
            'address'=>'required|max:50|string',
            'marital_status'=>'required|in:"خاطب/مخطوبة","متملك/متملكة","سنة أولى زواج"',
            'email'=>'required|email|max:50',
            'job'=>'required|max:50',
            'course_id'=>'exists:courses,id',
            'price'=>'exists:courses,price',
            'g-recaptcha-response' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'in'=>'هناك خطأ ما',
            'between'=>'السن يجب أن لا يقل عن 18 عام وان لا يزيد عن 40 عام',
            'size'=>'رقم الجوال غير صالح',
            'starts_with'=>'رقم الجوال غير صالح',
            'string'=>' يجب أن يحتوي الحقل على بيانات نصية',
            'numeric'=>' يجب أن يحتوي الحقل على بيانات رقمية',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',

        ];
    }
}
