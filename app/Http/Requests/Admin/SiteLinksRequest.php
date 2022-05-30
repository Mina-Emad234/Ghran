<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteLinksRequest extends FormRequest
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
            'name'=>'required|max:100',
            'site_section_id'=>'required|exists:site_sections,id',
            'parent_id'=>'nullable|exists:site_links,id',
            'link'=>'nullable|max:200',
            'g-recaptcha-response' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'exists'=>'حدث خطأ ما حاول مرة أخرى',
            'name.max'=>' الحد الأقصى 100 حرف',
            'link.max'=>' الحد الأقصى 200 حرف',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
