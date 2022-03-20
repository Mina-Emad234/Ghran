@extends('site.index')
@section('title','الكورسات المدفوعة')
@section('content')

    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">الكورسا المدفوعةت</h1>
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


            <aside>
                <div class="col-md-4">
                    <div class="sidebar">

                        <div class="arrow_box no-margin"><h3>أخر الأخبار</h3></div>
                        <ul class="news-menu margin-top-15">
                            @php
                                $all = \App\Models\Blog::where(['active'=>1,'category_id'=>2])->whereDate('created_at', \Carbon\Carbon::today())->latest()->limit(6)->get();
                            @endphp
                            @foreach ($all as $news)
                                <li><a href="{{route('post.show',$news->slug)}}">
                                        @if ($news->image != "" && file_exists("uploads/blogs/" . $news->image))
                                            <img src="{{'../../../uploads/blogs/'.$news->image}}" class="img-responsive" />
                                        @else
                                            <img src="{{asset('admins/images/no-img.png')}}" class="img-responsive"/>
                                        @endif
                                        <h5 style="font-size: 15px;font-weight: bold;line-height: 20px !important;text-align: center">{{strlen($news->title)>100?substr($news->title,0,strpos($news->title,' ',100)).'...': $news->title}}</h5>
                                    </a></li>

                            @endforeach
                        </ul>
                        <div class="clearfix"></div>



                    </div>

                </div>
            </aside>




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
