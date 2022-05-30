@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('videos.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>الفيديوهات </span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">تحديث الفيديو</div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('videos.update',$video->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث الفيديو</legend>
                        <input type="hidden" name="id" value="{{$video->id}}">
                        <label class="label">اسم الفيديو :</label>
                        <input id="name" class="textBox med rnd5" name="name" value="{{old('name',$video->name)}}" />
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label class="label">استاذ المادة :</label>
                        <input id="name" class="textBox med rnd5" name="author" value="{{old('author',$video->author)}}" />
                        @error('author')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الكورس :</label>
                        <select size="1" name="course_id" class="select rnd5">
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}" @if($course->id==old('course_id') || $course->id == $video->course_id) selected @endif>{{$course->name}}</option>
                            @endforeach
                        </select>
                        @error('course_id')
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
                            @if ($video->image != "" && file_exists("uploads/v_images/" . $video->image))
                                <img src="{{'../../../uploads/v_images/'. $video->image}}" width="160" height="130" class="imgPreview rnd10" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                            @endif
                        </p>

                        <label for="image" class="label">الفيديو</label>
                        <div class="fileUpload">
                            <input id="file" type="file" name="video"   />
                            <span class="button rnd5 drkTextShadow">جلب الملف</span>
                            @error('video')
                            <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                            @enderror
                        </div>
                        <br />
                        @php
                            $array=explode('.', $video->video);
                        @endphp
                        <label class="label">الفيديو الحالية</label>
                        @if ($video->video != "" && file_exists("uploads/v_videos/" . $video->video))
                        <video width="200" height="150" controls>
                            <source src="{{'../../../uploads/v_videos/'. $video->video}}" type='video/{{strtolower(end($array))}}'>
                            Your browser does not support the video tag.
                        </video>
                        @endif
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active',$video->active)==1) checked @endif/>
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
