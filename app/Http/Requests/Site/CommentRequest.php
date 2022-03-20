<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'writer'=>'required|max:50',
            'email'=>'required|max:50|email',
            'body'=>'required|max:500',
            'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 50 حرف',
            'body.max'=>' الحد الأقصى 500 حرف',
            'email'=>'يجب أن يحتوي البريد الالكتروني على الرمز @',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',

        ];
    }
}
