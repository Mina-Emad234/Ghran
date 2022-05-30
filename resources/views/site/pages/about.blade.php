@extends('site.index')
@section('title','عن اللجنة')
@section('content')

    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">عن اللجنة</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">عن اللجنة</li>
            </ul>
        </div>
    </div>
    <!-- start main -->

    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">
                    @foreach($about as $_about)
                    {!! $_about->body !!}
                    @endforeach

                    <div class="clearfix"></div>

                </div>
            </div>

            @include('site.news.news')






        </div>

    </section>
@endsection
