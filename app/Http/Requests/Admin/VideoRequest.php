<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'name'=>'required|max:100|unique:videos,name,'.$this->id,
            'author'=>'required|max:50',
            'course_id'=>'required|exists:courses,id',
            'video'=>'required_without:id|mimes:mp4,mkv,flv,3GP,avi,vob,mov|max:250000',
            'image'=>'required_without:id|mimes:jpg,gif,jpeg,png|max:4000',
            'g-recaptcha-response' => 'required'

        ];
    }
    public function messages()
    {
        return [
            'required'=>'إملأ الخقل',
            'required_without'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 100 حرف',
            'exists'=>'هذا الكورس غير موجود',
            'author.max'=>' الحد الأقصى 50 حرف',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'video.max'=>"حجم الملف لا يجب أن يكون أكبر من 250 ميجا",
            'mimes'=>"نوع الملف غير مسموح به",
            'g-recaptcha-response.required'=>'حدث خطأ ما حول مرة أخرى',

        ];
    }
}
