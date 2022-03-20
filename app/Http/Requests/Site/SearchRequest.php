<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search'=>'required',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',
        ];
    }
}
