<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SectionsRequest extends FormRequest
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
            'name'=>'required_without:id|max:100',
            'section_type'=>'required_without:id|in:images,pages,front links',
        ];
    }
    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'name.max'=>' الحد الأقصى 100 حرف',
            'in'=>'حدث خطأ ما',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
        ];
    }
}
