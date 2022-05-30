<?php

namespace App\Http\Requests\Api;

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
            'name'=>'required_without:id|max:100',
            'site_section_id'=>'required_without:id|exists:site_sections,id',
            'parent_id'=>'nullable|exists:site_links,id',
            'link'=>'nullable|max:200',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'exists'=>'حدث خطأ ما حاول مرة أخرى',
            'name.max'=>' الحد الأقصى 100 حرف',
            'link.max'=>' الحد الأقصى 200 حرف',
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
