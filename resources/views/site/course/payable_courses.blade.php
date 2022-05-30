@extends('site.index')
@section('title','الكورسات المدفوعة')
@section('content')

    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">الكورسات المدفوعة</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">الكورسات المدفوعة</li>
            </ul>
        </div>
    </div>
    <!-- start main -->

    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content" style="min-height: 800px;">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @forelse($courses as $course)
                        <div dir="rtl" class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{$course->id}}">
                                <h4 class="panel-title acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$course->id}}" aria-expanded="true" aria-controls="collapse{{$course->id}}">{{$course->name}}</h4>
                            </div>
                            <div id="collapse{{$course->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$course->id}}">
                                <div class="panel-body">

                                        <div class="col-md-3" style="margin-top: 15px">
                                            @if ($course->image != "" && file_exists("uploads/courses/" . $course->image))
                                                <img src="{{'../../../uploads/courses/'.$course->image}}" class="img-responsive" width="110" style="display: inline !important;"/>
                                            @else
                                                <img src="{{asset('admins/images/no-img.png')}}" width="110"/>
                                            @endif
                                        </div>
                                        <div class="col-md-9" style="font-size: 18px; line-height: 30px;text-wrap: normal;">
                                                 {!! $course->description !!}
                                            <p>سعر الدورة: {{currency($course->price)}}</p>
                                            <p>للإشتراك في الدورة إضغط <a href="{{route('course_applicant.register',$course->id)}}"><b>هنا</b></a></p>
                                        </div>


                                </div>
                            </div>
                        </div>
                        @empty
                            <h4 style="text-align: center">لا توجد كورسات لعرضها</h4>
                        @endforelse
                    </div>
                    <div align="center">
                        {!! $courses->appends(['sort' => 'science-stream'])->links("pagination::bootstrap-4") !!}
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
