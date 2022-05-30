<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'writer'=>'required_without:id|max:50',
            'email'=>'required_without:id|max:50|email',
            'body'=>'required_without:id|max:500',
            'blog_id'=>'required_without:id|exists:blogs,id',
            'parent_id'=>'nullable|exists:comments,id'
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'body.max'=>' الحد الأقصى 500 حرف',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'exists'=>'حدث خطأ ما حاول مرة أخرى'
        ];
    }
}
