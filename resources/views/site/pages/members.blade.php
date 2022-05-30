@extends('site.index')
@section('title','أعضاء اللجنة')
@section('content')
<div class="banner-inner">
    <div class="container">
        <h1 class="pull-right">أعضاء اللجنة</h1>
        <ul class="breadcrumb pull-left">
            <li><a href="{{route('home')}}">الرئيسية</a></li>
            <li class="active">أعضاء اللجنة</li>
        </ul>
    </div>
</div>






<section class="gray">

    <div class="container" id="resp-height">

        <div class="col-md-8">
            <div class="content">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($members as $member)
                        <div dir="rtl" class="panel panel-default" id="{{$member->id}}">
                            <div class="panel-heading" role="tab" id="heading{{$member->id}}">
                                <h4 class="panel-title acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$member->id}}" aria-expanded="true" aria-controls="collapse{{$member->id}}">{{$member->title}}</h4>
                            </div>
                            <div id="collapse{{$member->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$member->id}}">
                                <div class="panel-body">

                                    {!! $member->body !!}


                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <div align="center">
                    {!! $members->appends(['sort' => 'science-stream'])->links("pagination::bootstrap-4") !!}
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
