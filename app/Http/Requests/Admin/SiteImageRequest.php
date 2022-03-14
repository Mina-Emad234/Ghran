<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteImageRequest extends FormRequest
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
            'site_part'=>'required|in:main,support',
            'image'=>'required|mimes:jpg,gif,jpeg,png|max:6000'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'in'=>'حدث خطأ ما',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 6 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
        ];
    }
}
