@extends('site.index')
@section('title',$photos->name)
@section('content')
<!-- start slider -->
<div class="banner-inner">
    <div class="container">
        <h1 class="pull-right">{{$photos->name}}</h1>
        <ul class="breadcrumb pull-left">
            <li><a href="{{route('home')}}">الرئيسية</a></li>
            <li class="active">{{$photos->name}}</li>
        </ul>
    </div>
</div>
<!-- start main -->

<section class="gray">

    <div class="container" id="resp-height">

        <div class="col-md-8">
            <div class="content">
                @if (!empty($photos->photos) and count($photos->photos) > 1 )
                <div class="owl-carousel" id="Testimonials">
                    @foreach ($photos->photos as $photo)
                    <div class="item" >
                        <div class="row row-centered">
                            <div class="row-md-12 col-centered">
                                <div>
                                    @if($photo->photo != "" && file_exists("uploads/photos/" . $photo->photo))
                                    <img src="{{'../../../uploads/photos/'.$photo->photo}}" class="img-responsive" />
                                    @else
                                    <img src="{{asset('admins/images/no-img.png')}}" class="img-circle img-responsive" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                @else
                <p class="lead">لا توجد صور</p>
                @endif

                <div class="clearfix"></div>

            </div>
        </div>




@include('site.news.news')

    </div>

</section>
@endsection
