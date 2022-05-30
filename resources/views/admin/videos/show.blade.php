@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">الفيديو</div>
            <div class="content">
                <a href="{{route('videos.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الفيديوهات</span>
                </a>
                <a href="{{route('courses.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الكورسات</span>
                </a>
                <br /><br /><br />
                <strong>إسم الفيديو : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$video->name}}<br>



                <strong>أستاذ المادة : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$video->author}}<br>

                <strong>تاريخ الفيديو : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span dir="ltr">{{$video->created_at->diffForHumans()}}</span><br>
                <br>

                <strong>عنوان الرسالة : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$video->title}}<br>

                <strong>الكورس : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$video->course->name}}<br>

                <label class="label">الصورة</label>
                <p style="margin-right: 50px">
                    @if ($video->image != "" && file_exists("uploads/v_images/" . $video->image))
                        <img src="{{'../../../uploads/v_images/'. $video->image}}" width="160" height="130" class="imgPreview rnd10" />
                    @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                    @endif
                </p>

                @php
                    $array=explode('.', $video->video);
                @endphp
                <label class="label">الفيديو الحالية</label><br>
                @if ($video->video != "" && file_exists("uploads/v_videos/" . $video->video))
                    <video width="400" height="200" controls>
                        <source src="{{'../../../uploads/v_videos/'. $video->video}}" type='video/{{strtolower(end($array))}}'>
                            Your browser does not support the video tag.
                    </video>
                        @endif
            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
