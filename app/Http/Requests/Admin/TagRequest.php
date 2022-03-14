<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name'=>'required|max:50|unique:tags,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'name.max'=>' الحد الأقصى 50 حرف',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
        ];
    }
}
