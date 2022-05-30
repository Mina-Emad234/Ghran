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
            <img class="img-responsive suport" src="{{asset('site/img/'.$image)}}"/>

            @foreach($support as $_support)
                <h3 id="{{$_support->id}}">{{$_support->title}}</h3>
                {!!$_support->body!!}
            @endforeach
        </div>

    </section>
@endsection
