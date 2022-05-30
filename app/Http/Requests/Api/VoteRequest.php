<?php

namespace App\Http\Requests\Api;

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
            'question'=>'required_without:id|max:200|ends_with:?,؟',
            'answer1'=>'required_without:id|max:100',
            'answer2'=>'required_without:id|max:100',
            'answer3'=>'required_without:id|max:100',
            'answer4'=>'required_without:id|max:100',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'question.max'=>' الحد الأقصى 200 حرف',
            'ends_with'=>'يجب أن ينتهي السؤال يعلامة إستفهام',
            'max'=>' الحد الأقصى 100 حرف',
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
