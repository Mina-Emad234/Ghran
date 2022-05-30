<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class VideosRequest extends FormRequest
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
            'name'=>'required_without:id|max:100|unique:videos,name,'.$this->id,
            'author'=>'required_without:id|max:50',
            'course_id'=>'required_without:id|exists:courses,id',
            'video'=>'required_without:id|mimes:mp4,mkv,flv,3GP,avi,vob,mov|max:250000',
            'image'=>'required_without:id|mimes:jpg,gif,jpeg,png|max:4000',
            'active'=>'required_without:id|In:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required_without'=>'إملأ الخقل',
            'max'=>' الحد الأقصى 100 حرف',
            'exists'=>'هذا الكورس غير موجود',
            'author.max'=>' الحد الأقصى 50 حرف',
            'unique'=>'هذا الاسم موجود بالفعل من فضلك ضع اسم غير موجود من قبل',
            'image.max'=>"حجم الملف لا يجب أن يكون أكبر من 4 ميجا",
            'videos.max'=>"حجم الملف لا يجب أن يكون أكبر من 250 ميجا",
            'mimes'=>"نوع الملف غير مسموح به",
            'active.in'=>'يجب أن تكون القيمة 0 أو 1',
        ];
    }
}
