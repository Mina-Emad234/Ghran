@extends('site.index')
@section('title',$video->name)
@section('content')
    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">{{$video->name}}</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">{{$video->name}}</li>
            </ul>
        </div>
    </div>
    <!-- start main -->

    <section class="gray">

        <div class="container" id="resp-height">
            @php
                $array = explode('.', $video->video);
            @endphp
            <div class="col-md-8">
                <div class="content">
                    <video width='100%' height='50%' controls>
                        <source src="{{'../../../uploads/v_videos/'.$video->video}}" type="video/{{strtolower(end($array))}}">
                        Your browser does not support the video tag.
                    </video>
                    <h3 style="text-align: center">By: {{$video->author}}</h3>
                    <div class="clearfix"></div>

                </div>
            </div>

            @include('site.news.news')





        </div>

    </section>

@endsection
