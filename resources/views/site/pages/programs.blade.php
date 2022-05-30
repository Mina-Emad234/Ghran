@extends('site.index')
@section('title','برامجنا')
@section('content')
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">برامجنا</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">برامجنا</li>
            </ul>
        </div>
    </div>


    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($programs as $program)
                            <div dir="rtl" class="panel panel-default" id="{{$program->id}}">
                                <div class="panel-heading" role="tab" id="heading{{$program->id}}">
                                    <h4 class="panel-title acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$program->id}}" aria-expanded="true" aria-controls="collapse{{$program->id}}">{{$program->title}}</h4>
                                </div>
                                <div id="collapse{{$program->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$program->id}}">
                                    <div class="panel-body">

                                        {!! $program->body !!}


                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                </div>


                <div class="clearfix"></div>

            </div>


            @include('site.news.news')





        </div>

    </section>

@endsection
@push('scripts')
    <script>
        $(function (){
            $('#accordion div:first-child .panel-collapse').addClass('in');
        });
    </script>
@endpush
