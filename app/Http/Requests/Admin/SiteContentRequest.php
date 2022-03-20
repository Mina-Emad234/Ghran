<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteContentRequest extends FormRequest
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
            'title'=>'required|max:100|unique:site_contents,title,'.$this->id,
            'site_section_id'=>'required|exists:site_sections,id',
            'body'=>'required',
            'g-recaptcha-response' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'exists'=>'حدث خطأ ما حاول مرة أخرى',
            'title.max'=>' الحد الأقصى 100 حرف',
            'section.max'=>' الحد الأقصى 50 حرف',
            'unique'=>'هذا العنوان موجود بالفعل من فضلك ضع عنوانًا غير موجود من قبل',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
