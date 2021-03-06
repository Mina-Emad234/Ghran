@extends('site.index')
@section('title','خريطة الموقع')
@section('content')
    <div id="middleContent">
        <!-- Bread Crumb Start -->
        <div class="banner-inner">
            <div class="container">
                <div class="breadCrumb">
                    <h1 class="current">خريطة الموقع</h1>
                    <div id="map" style="width:100%;height:250px;">
                        <ul class="breadcrumb pull-left">
                            <li><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="active">خريطة الموقع</li>
                        </ul>
                    </div>
                </div><!-- Bread Crumb End -->
                <!-- Sitmap Start -->


            </div>
        <section class="gray">

            <div class="container" id="resp-height">

                <div class="col-md-6">
                    <div class="content">
                        <h3 class="title">روابط مهمة</h3>

                        <ul class="menu" style="list-style: none">
                            @if($links)
                            @foreach($links->links as $link)
                                    <li><a href="{{url($link->link)}}">{{$link->name}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div><!-- Menu End -->
                </div><!-- Sitmap End -->
                <div class="col-md-6">
                    <div class="content">
                        <h3 class="title">الأقسام</h3>

                        <ul class="menu" style="list-style: none">
                            @foreach ($categories as $cat)
                            <li><a href="{{route('post.index',$cat->slug)}}">{{$cat->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- Menu End -->
                </div><!-- Sitmap End -->

            </div><!-- middle Column End -->
@endsection
