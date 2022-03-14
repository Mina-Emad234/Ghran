<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoteQuestionRequest extends FormRequest
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
            'question'=>'required|max:200|ends_with:?,؟',
            'answer1'=>'required|max:100',
            'answer2'=>'required|max:100',
            'answer3'=>'required|max:100',
            'answer4'=>'required|max:100'
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'question.max'=>' الحد الأقصى 200 حرف',
            'ends_with'=>'يجب أن ينتهي السؤال يعلامة إستفهام',
            'max'=>' الحد الأقصى 100 حرف',
        ];
    }
}
