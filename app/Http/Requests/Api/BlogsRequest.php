<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BlogsRequest extends FormRequest
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
            'category_id'=>'required_without:id|exists:blog_categories,id',
            'title'=>'required_without:id|max:150|unique:blogs,title,'.$this->id,
            'body'=>'required_without:id|min:150|max:3000',
            'image'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:4000',
            'tags'=>'required_without:id|array|min:1',
            'tags.*'=>'exists:tags,id',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'exists'=>'هذا القسم غير موجود',
            'tags.exists'=>'هذه الكلمة غير موجود',
            'title.max'=>' الحد الأقصى 150 حرف',
            'body.max'=>' الحد الأقصى 3000 حرف',
            'body.min'=>' الحد الادنى 150 حرف',
            'unique'=>'هذا العنوان موجود بالفعل من فضلك ضع عنوانًا غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'image.mimes'=>"نوع الملف غير مسموح به",
            'tags.min'=>'إختار كلمة بحث أو أكثر',
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
