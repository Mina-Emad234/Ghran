<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SiteContentsRequest extends FormRequest
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
            'title'=>'required_without:id|max:100|unique:site_contents,title,'.$this->id,
            'site_section_id'=>'required_without:id|exists:site_sections,id',
            'body'=>'required_without:id',
            'active'=>'required_without:id|In:0,1',

        ];
    }
    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'exists'=>'حدث خطأ ما حاول مرة أخرى',
            'title.max'=>' الحد الأقصى 100 حرف',
            'section.max'=>' الحد الأقصى 50 حرف',
            'unique'=>'هذا العنوان موجود بالفعل من فضلك ضع عنوانًا غير موجود من قبل',
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',

        ];
    }
}
