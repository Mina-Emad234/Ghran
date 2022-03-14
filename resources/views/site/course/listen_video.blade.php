@extends('site.index')
@section('title',$video->name)
@section('content')
    <!-- start slider -->
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">{{$video->name}}</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">{{$video->name}}</li>
            </ul>
        </div>
    </div>
    <!-- start main -->

    <section class="gray">

        <div class="container" id="resp-height">
            @php
                $array = explode('.', $video->video);
            @endphp
            <div class="col-md-8">
                <div class="content">
                    <video width='100%' height='50%' controls>
                        <source src="{{'../../../uploads/v_videos/'.$video->video}}" type="video/{{strtolower(end($array))}}">
                        Your browser does not support the video tag.
                    </video>
                    <h3 style="text-align: center">By: {{$video->author}}</h3>
                    <div class="clearfix"></div>

                </div>
            </div>

            <aside>
                <div class="col-md-4">
                    <div class="sidebar">

                        <div class="arrow_box no-margin"><h3>أخر الأخبار</h3></div>
                        <ul class="news-menu margin-top-15">
                            @php
                                $all = \App\Models\Blog::where(['active'=>1,'category_id'=>2])->latest()->limit(6)->get();
                            @endphp
                            @forelse ($all as $news)
                                <li><a href="{{route('post.show',$news->slug)}}">
                                        @if ($news->image != "" && file_exists("uploads/blogs/" . $news->image))
                                            <img src="{{'../../../uploads/blogs/'.$news->image}}" class="img-responsive" />
                                        @else
                                            <img src="{{asset('admins/images/no-img.png')}}" class="img-responsive"/>
                                        @endif
                                        <h5 style="font-size: 15px;font-weight: bold;line-height: 20px !important;text-align: center">{{strlen($news->title)>100?substr($news->title,0,strpos($news->title,' ',100)).'...': $news->title}}</h5>
                                    </a></li>
                            @empty
                                <li><h3 style="text-align: center">لا يوجد أخبار لعرضها حاليا</h3></li>
                            @endforelse
                        </ul>
                        <div class="clearfix"></div>



                    </div>

                </div>
            </aside>




        </div>

    </section>

@endsection
