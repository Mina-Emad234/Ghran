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
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title acc-head active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">بدر بن عبد الله الرواف</h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">

                                <h4>رئيس مجلس الأدارة</h4>
                            </div>
                        </div>
                    </div>




                </div>





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
