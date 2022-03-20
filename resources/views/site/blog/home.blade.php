@extends('site.index')
@section('title','الرئيسية')
@section('stylesheets')
    <style>
    .banner-main {
        min-height: 507px;
        background: url({{asset('site/img/'.$data['image'])}}) no-repeat top center;
        background-size: cover;
    }
</style>
@endsection
@section('content')

    <section>
        @if(count($data['latest_tickers'])>0)
        <div class="container">
            <div class="col-lg-1 col-md-2 col-sm-2 ticker-title no-padding"><h2>أخر الأخبار</h2></div>
            <div class="col-lg-11 col-md-10 col-sm-10 no-padding">
                <ul id="ticker">
                    @foreach($data['latest_tickers'] as $ticker)
                    <li><a href="{{route('post.show',$ticker->slug)}}"> {{$ticker->title}} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </section>
    <div class="banner-main">
        <div class="container">
            <div class="col-md-7 margin-top-30">
                @php
                    $course=$data['paid_course'];
                @endphp
                @if(!empty($course))
                <h2>{{substr($course->name,0,strpos($course->name,' ',15))}}<br><span>{{substr($course->name,strpos($course->name,' ',15))}}</span></h2>
                <br/>
                {!! $course->description !!}
                <div class="box-darg margin-top-30">
                    <div class="pull-right margin-left-30">
                        {!! $data['offer'] !!}
{{--                        <p class="price font">5000<br/>ريـــــــــــــــــال</p>--}}
{{--                        <p class="font">سحب على إعانة زواج في كل دورة</p>--}}
                    </div>
                    <div class="pull-left margin-top-15"><a href="{{route('course_applicant.register',$course->id)}}" class="btn btn-custom big">نموذج التسجيل</a></div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="tab-master">

        <ul class="nav nav-tabs nav-justified responsive margin-bottom-40" id="tab-master">
            <li class="test-class"><a href="#mqal"><i class="fa fa-bookmark-o"></i> المقالات</a></li>
            <li class="test-class active"><a href="#news-tab"><i class="fa fa-file-text-o"></i> الأخبار</a></li>
            <li><a class="deco-none" href="#nesaa"><i class="fa fa-diamond"></i> القسم النسائي</a></li>
        </ul>


        <div class="tab-content responsive container">

            <div class="tab-pane" id="mqal">

                <div class="col-md-4">
                    <div class="news-box">
                        @if(!empty($article))
                        @if ($article->image != "" && file_exists("uploads/blogs/" . $article->image))
                            <img src="{{'../../../uploads/blogs/'.$article->image}}" class="img-responsive" />
                        @else
                            <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                        <h3>{{$article->title}}</h3>
                            <p>{!! substr($article->body,0,strpos($article->body,' ',150)).'...' !!}</p>
                            <a href="{{route('post.show',$article->slug)}}">أقرا المزيد ..</a>
                            <div class="comment">
                                <div><p class="font">تاريخ النشر<span class="number">{{ date("F j, Y ", strtotime($article->created_at))}}</span></p></div>
                            </div>
                        @else
                            <h4 style="text-align: center">لا توجد مقالات لعرضها حاليا</h4>
                        @endif
                    </div>
                </div>

            </div><!--/.mqal -->






            <div class="tab-pane active" id="news-tab">

                <div class="col-md-4">
                    <div class="news-box">
                        @if(!empty($news))
                                @if($news->image != "" && file_exists("uploads/blogs/" . $news->image))
                                    <img src="{{'../../../uploads/blogs/'.$news->image}}" class="img-responsive" />
                                @else
                                    <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                                @endif
                                <h3>{{$news->title}}</h3>
                                    <p>{!!substr($news->body,0,strpos($news->body,' ',150)).'...'!!}</p>
                                <a href="{{route('post.show',$news->slug)}}">أقرا المزيد ..</a>
                                <div class="comment">
                                    <div><p class="font">تاريخ النشر<span class="number">{{ date("F j, Y ", strtotime($news->created_at))}}</span></p></div>
                                </div>
                        @else
                            <h4 style="text-align: center">لا توجد أخبار لعرضها حاليا</h4>
                        @endif
                    </div>
                </div>
            </div><!--/.news-tab -->


            <div class="tab-pane" id="nesaa">


                <div class="col-md-4">
                    <div class="news-box">
                        @if(!empty($woman))
                                @if ($woman->image != "" && file_exists("uploads/blogs/" . $woman->image))
                                    <img src="{{'../../../uploads/blogs/'.$woman->image}}" class="img-responsive" />
                                @else
                                    <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                                @endif
                                <h3>{{$woman->title}}</h3>
                                <p>{!!substr($woman->body,0,strpos($woman->body,' ',150)).'...'!!}</p>
                                <a href="{{route('post.show',$woman->slug)}}">أقرا المزيد ..</a>
                                <div class="comment">
                                    <div><p class="font">تاريخ النشر<span class="number">{{ date(" F j, Y ", strtotime($woman->created_at))}}</span></p></div>
                                </div>
                        @else
                            <h4 style="text-align: center">لا توجد مقالات نسائية لعرضها حاليا</h4>
                        @endif

                    </div>
                </div>
            </div><!--/.nesaa -->


        </div><!--/.tab-content + container -->

    </div><!--/.tab-master  -->

    <div class="Testimonials">

        <div class="container">




            <div class="col-md-8">
                <div class="heading">
                    <h3>قالوا عنا</h3>
                    <span class="diver"></span>
                </div>
                @if(!empty($data['testimonials'] ) and $data['testimonials_count'] > 1 )
                <div class="owl-carousel" id="Testimonials">
                    @foreach ($data['testimonials'] as $testimonial)
                    <div class="item">
                        <div class="row row-centered">
                            <div class="row-md-12 col-centered">
                                <div class="col-sm-3 text-center">
                                    @if($testimonial->image != "" && file_exists("uploads/blogs/".$testimonial->image))
                                        <img src="{{'../../../uploads/blogs/'.$testimonial->image}}" class="img-responsive" />
                                    @else
                                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <p>{!! $testimonial->body !!}</p>
                                    <a href="{{route('post.show',$testimonial->slug)}}"><small>{{$testimonial->title}}</small></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                @else
                    <h4 style="text-align: center">لا توجد منشورات لعرضها حاليا</h4>
                @endif

            </div><!--/.col-md-8  -->

            <!-- Vote Start -->
            <div class="col-md-4 margin-top-30">
                <div class="box-vote">
                    @if($vote !=null )
                    @if(session()->has('vote_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('vote_success')}}</strong>
                        </div>
                    @endif

                        @if(session()->has('vote_error'))
                        <div class="alert alert-error">
                            <strong>{{session()->get('vote_error')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['vote_id']) && $vote->id == $_COOKIE['vote_id'])
                        <div class="alert alert-info">
                            <strong>تم التصويت من قبل</strong>
                        </div>
                            <a href="" id="{{route('vote.result',$vote->id)}}" class="btn btn-secondary btn-block" >نتائج التصويت</a>
                            <a href="{{route('vote.previous')}}" style="font-weight:bold;margin:10px auto 0;display:block">استطلاعات سابقة</a>
                    @else
                    @php
                        unset($_COOKIE['vote_id']);
                        setcookie('vote_id', null, -1, '/');
                    @endphp

                <form method="post" action="{{route('vote.answer',$vote->id)}}">
                    @CSRF
                    <fieldset class="form  vote">
                        <div class="box-vote-head">{{$vote->question}}</div>
                        <div class="box-vote-content">

                            <input name="answer" type="radio" id="answer1" value="1" checked="checked" />
                            <label for="answer1" class="label">{{$vote->answer1}}</label><br />

                            <input name="answer" type="radio" id="answer2" value="2" />
                            <label for="answer2" class="label">{{$vote->answer2}}</label><br />

                            <input name="answer" type="radio" id="answer3" value="3" />
                            <label for="answer3" class="label">{{$vote->answer3}}</label><br />

                            <input name="answer" type="radio" id="answer3" value="4" />
                            <label for="answer4" class="label">{{$vote->answer4}}</label><br />
                            {!! RecaptchaV3::field('vote') !!}

                            <input name="votes" id="votes"  class="btn btn-custom btn-block"  type="submit"  value="تصويت" />
                            <a href="{{route('vote.result',$vote->id)}}" id="results" class="btn btn-secondary btn-block" >نتائج التصويت</a>
                            <a href="{{route('vote.previous')}}" style="font-weight:bold;margin:10px auto 0;display:block">استطلاعات سابقة</a>
                    </fieldset>
                    </form>
                    @endif
                    @else
                    <p class="notice error">عفوا لا يوجد إستطلاع للرأى حتى الان</p>
                    @endif
                </div>
            </div>
            <!-- Vote End -->





        </div><!--/.container  -->


    </div><!--/.Testimonials  -->
    <div class="partners">
        <div class="container">
            @if(count($data['partners'])>0)
            <div class="heading">
                <h3>شــــــركاؤنا</h3>
                <span class="diver"></span>
            </div>
            <div class="owl-carousel" id="partners">
                @foreach($data['partners'] as $partner)
                    @if($partner->image != "" && file_exists("uploads/partners/" . $partner->image))
                        <div class="item"><img src="{{'../../../uploads/partners/'.$partner->image}}" class="img-responsive" /></div>
                    @else
                        <div class="item"><img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" /></div>
                    @endif
                    @endforeach
            </div>
            @endif
        </div>
    </div><!--/.partners  -->

@endsection
@push('scripts')
    <script>
        $(function (){
            $('.banner-main div div p').addClass('font');
            $('.banner-main div div div p:first-child').addClass('price');
        });
    </script>
    @endpush
