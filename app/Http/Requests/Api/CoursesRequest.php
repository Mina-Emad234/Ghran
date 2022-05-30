<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'name'=>'required_without:id|max:100|unique:courses,name,'.$this->id,
            'description'=>'required_without:id|max:1000',
            'duration'=>'required_without:id|numeric',
            'licence'=>'required_without:id|max:100',
            'price'=>'required_with:course_payable|nullable|numeric',
            'image'=>'required_without:id|mimes:jpg,gif,jpeg,png|max:4000',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'required_with'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 100 حرف',
            'description.max'=>' الحد الأقصى 1000 حرف',
            'numeric'=>'يجب أن لا يحتوي هذا الحقل على رموز أو أحرف',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
