<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'sender'=>'required|max:50',
            'email'=>'required|email|max:50',
            'title'=>'required|max:50',
            'content'=>'required|max:1000',
            'file'=>'mimes:jpg,gif,jpeg,png,mp4,pdf,txt,mkv,flv,docs,doc,3gb,xlsx,pptx|max:4000',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'content.max'=>' الحد الأقصى 1000 حرف',
            'file.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'file.mimes'=>"نوع الملف غير مسموح به",
        ];
    }
}
