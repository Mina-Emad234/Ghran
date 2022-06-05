@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('videos.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الفيديوهات </span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">إضافة فيديو جديد </div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('videos.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة فيديو جديد</legend>

                    <label class="label">اسم الفيديو :</label>
                    <input id="name" class="textBox med rnd5" name="name" value="{{old('name')}}" />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />

                    <label class="label">استاذ المادة :</label>
                    <input id="name" class="textBox med rnd5" name="author" value="{{old('author')}}" />
                    @error('author')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />
                    <label class="label">الكورس :</label>
                    <select size="1" name="course_id" class="select rnd5">
                        @foreach ($courses as $course)
                            <option value="{{$course->id}}" @if($course->id==old('course_id')) selected @endif>{{$course->name}}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />

                    <label for="image" class="label">الصورة</label>
                    <div class="fileUpload">
                        <input id="inputImage" type="file" name="image"   />
                        <span class="button rnd5 drkTextShadow">جلب الملف</span>
                        @error('image')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                    </div>
                    <br />
                    <div class="col-md-12 mb-2">
                        <img id="preview-image" width="200px" style="margin: 10px">
                    </div>
                    <br />
                    <label for="image" class="label">الفيديو</label>
                    <div class="fileUpload">
                        <input id="file" type="file" name="video"   />
                        <span class="button rnd5 drkTextShadow">جلب الملف</span>
                        @error('video')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                    </div>
                    <br />


                    <label for="chk1" class="label">تفعيل</label>
                    <input type="checkbox" name="status" id="chk1" value="1" @if(old('status')==1) checked @endif/>
                    <br />
                    {!! RecaptchaV3::field('videos') !!}
                    @error('g-recaptcha-response')
                    <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
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
