<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PhotosRequest extends FormRequest
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
            'photos'=>'required|array|min:1',
            'photos.*'=>'required|max:4000|mimes:jpg,jpeg,gif,png',
            'album_id'=>'required|exists:albums,id',
            'active'=>'required_without:id|In:0,1',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'exists'=>'قسم الصور غير موجود',
            'max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'mimes'=>"نوع الملف غير مسموح به",
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
