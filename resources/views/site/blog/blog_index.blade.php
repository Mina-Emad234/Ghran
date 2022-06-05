@extends('site.index')
@section('title',$category->name??'المنشورات')
@section('content')
    <div class="partners">
        <div class="container">
            <div class="heading">

                <h3>{{$category->name??'التدوينات'}}</h3>

                <span class="diver"></span>
            </div>
            @if(isset($blogs) && count($blogs) > 0 || isset($category->blogs) && count($category->blogs) > 0 )
            <div class="owl-carousel" id="partners">
                @foreach ($blogs as $blog)
                    <div class="col-3 margin-bottom-30">
                        <div class="partner-box">
                            @php
                            if(isset($category)){
                                $cat = $category->name;
                            }else{
                                $cat = $blog->category->name;
                            }
                            @endphp
                            @if ($blog->image != "" && file_exists("uploads/blogs/" .$cat.'/'. $blog->image))
                                <img src="{{'../../../uploads/blogs/'.$cat.'/'.$blog->image}}" class="img-responsive" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" />
                            @endif
                                <a href="{{route('post.show',$blog->slug)}}"><h4>{{$blog->title}}</h4></a>
                        </div>

                </div>
                @endforeach

            </div>
            @else
                <h4 style="text-align: center">لا توجد منشورات لعرضها حالياً</h4>
            @endif
        </div>
    </div><!--/.partners  -->

@endsection
