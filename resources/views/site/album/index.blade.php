@extends('site.index')
@section('title','الإستوديو')
@section('content')
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">المعارض</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">المعارض</li>
            </ul>
        </div>
    </div>

    <section class="Listing">
        <div class="container">
        @if(count($albums)>0)
            <div class="owl-carousel" id="partners">
                @foreach ($albums as $album)
                <div class="col-3 margin-bottom-30">
                    <a href="{{route('album_cat.photos',$album->id)}}">
                        <img src="{{'../../../uploads/albums/'.$album->image}}" class="img-responsive"/>
                        <h4 class="text-center">{{$album->name}}</h4>
                    </a>
                </div>
                @endforeach
            </div>
            @else
                <h4 style="text-align: center">لا توجد ألبومات لعرضها حالياً</h4>
            @endif

            <div class="clearfix"></div>



        </div>

    </section>

@endsection
