@extends('site.index')
@section('title','ادعمنا')
@section('content')
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">ادعمنا</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">ادعمنا</li>
            </ul>
        </div>
    </div>


    <section class="inner">
        <div class="container">
            @if($image->image)
                <img class="img-responsive suport" src="{{asset('site/img/'.$image->image->image)}}"/>
            @else
                <img class="img-responsive suport" src="{{asset('admins/images/no-img.png')}}"/>
            @endif
            @if($support)
            @foreach($support->site_contents as $_support)
                <h3 id="{{$_support->id}}">{{$_support->title}}</h3>
                {!!$_support->body!!}
            @endforeach
                @else
                <h3>لا يوجد محتوى</h3>
            @endif
        </div>

    </section>
@endsection
