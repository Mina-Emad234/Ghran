<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
            'body'=>'required_without:id|max:500',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'name.max'=>' الحد الأقصى 500 حرف',
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
