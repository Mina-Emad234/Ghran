@extends('admin.index')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/easyui/themes/icon.css')}}">
    <script type="text/javascript" src="{{asset('admin/easyui/jquery.easyui.min.js')}}"></script>

    <div id="middleContent">
        <a href="{{route('course.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>الكورسات المجانية</span>
        </a>
        <a href="{{route('course.payable')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>الكورسات المدفوعة</span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">تحديث الكورس</div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('course.update',$course->id)}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث الكورس</legend>
                        <input type="hidden" name="id" value="{{$course->id}}">
                        <label class="label">اسم الكورس :</label>
                        <input id="name" class="textBox med rnd5" name="name" value="{{old('name',$course->name)}}" />
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">سعر الكورس :</label>
                        <input id="price" class="textBox med rnd5" name="price" value="{{old('price',$course->price)}}" />
                        @error('price')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الوصف :</label>
                        <textarea  name="description" id="textEditor" rows="6" cols="0" class="textArea lrg rnd5">{{old('description',$course->description)}}</textarea><br /><br />
                        @error('description')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="image" class="label">الصورة</label>
                        <div class="fileUpload">
                            <input id="file" type="file" name="image"   />
                            <span class="button rnd5 drkTextShadow">جلب الملف</span>
                            @error('image')
                            <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                            @enderror
                        </div>
                        <br />
                        <label class="label">الصورة الحالية</label>
                        <p style="margin-right: 50px">
                            @if ($course->image != "" && file_exists("uploads/courses/" . $course->image))
                                <img src="{{'../../../uploads/courses/'. $course->image}}" width="160" height="130" class="imgPreview rnd10" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                            @endif
                        </p>
                        <br />
                        <label class="label">عدد الساعات :</label>
                        <input type="number" id="duration" class="textBox med rnd5" name="duration" value="{{old('duration',$course->duration)}}" />
                        @error('duration')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">رخصة الكورس :</label>
                        <input id="licence" class="textBox med rnd5" name="licence" value="{{old('licence',$course->licence)}}" />
                        @error('licence')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active',$course->active)==1) checked @endif/>
                        <br />

                        <label for="chk2" class="label">هل الكورس مدفوع أو مجاني؟</label>
                        <input type="checkbox" name="course_payable" id="chk2" value="1" @if(old('course_payable',$course->course_payable)==1) checked @endif/>
                        <br />
                        <div class="center">
                            <input id="submit" type="submit" value="أدخل" class="button sml inlineBlock rnd5 drkTextShadow" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

@endsection
