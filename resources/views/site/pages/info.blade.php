@extends('site.index')
@section('title','معلومات')
@section('content')
<!-- start slider -->
<div class="banner-inner">
    <div class="container">
        <h1 class="pull-right">معلومات</h1>
        <ul class="breadcrumb pull-left">
            <li><a href="{{route('home')}}">الرئيسية</a></li>
            <li class="active">معلومات</li>
        </ul>
    </div>
</div>
<!-- start main -->

<section class="gray">

    <div class="container" id="resp-height">

        <div class="col-md-8">
            <div class="content" style="min-height: 800px">
                <div class="panel panel-default" dir="rtl">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="false" aria-controls="collapse">معلومات قد تهمك</h4>
                    </div>
                    <div id="collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <ol id="vertical-ticker" dir="rtl">

                                @foreach ($infos as $info)
                                <li><a>{!! $info->body !!}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

            </div>
        </div>

        @include('site.news.news')







    </div>

</section>
@endsection
