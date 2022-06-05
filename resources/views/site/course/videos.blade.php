@extends('site.index')
@section('title',$course->name)
@section('content')
    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">{{$course->name}}</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="#">الرئيسية</a></li>
                <li class="active">{{$course->name}}</li>
            </ul>
        </div>
    </div>
    <!-- start main -->

    <section class="gray">

        <div class="container" id="resp-height">

            @if(count($course->videos) > 0)
            <div class="owl-carousel" id="partners" dir="ltr">
                @php
                $i=0;
                @endphp
                @foreach ($course->videos as $video)
                <div class="margin-bottom-30" dir="ltr">
                    <a href="{{route('video',$video->id)}}">
                        <div class="news-box">
                            @if (!empty($course->image) && file_exists("uploads/v_images/" .$course->name.'/'. $video->image))
                                <img src="{{'../../../uploads/v_images/'.$course->name.'/'.$video->image}}" class="img-responsive" width="400" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" width="400"  class="img-responsive" />
                            @endif                            <h3>{{++$i . '_' . $video->name}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="clearfix"></div>

            </div>
        </div>

        @else
            <h4 style="text-align: center">لا توجد فيديوهات لعرضها</h4>
        @endif





    </section>

@endsection
