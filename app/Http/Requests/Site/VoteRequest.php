<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
            'answer'=>'required',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'حدث خطأ ما حول مرة أخرى',
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
