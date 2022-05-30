<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PartnersRequest extends FormRequest
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
            'name'=>'required_without:id|max:100|unique:partners,name,'.$this->id,
            'image'=>'required_without:id|mimes:jpg,gif,jpeg,png|max:4000',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'required_without'=>'إملأ الخقل',
            'name.max'=>' الحد الأقصى 100 حرف',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
