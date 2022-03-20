<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'category_id'=>'required|exists:blog_categories,id',
            'title'=>'required|max:150|unique:blogs,title,'.$this->id,
            'body'=>'required|max:3000',
            'image'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:4000',
            'tags'=>'array|min:1',
            'tags.*'=>'numeric|exists:tags,id',
            'g-recaptcha-response' => 'required'

        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'required_without'=>'إملأ الخقل',
            'exists'=>'هذا القسم غير موجود',
            'tags.exists'=>'هذه الكلمة غير موجود',
            'title.max'=>' الحد الأقصى 150 حرف',
            'body.max'=>' الحد الأقصى 3000 حرف',
            'unique'=>'هذا العنوان موجود بالفعل من فضلك ضع عنوانًا غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
            'tags'=>'إختار كلمة بحث أو أكثر',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
