@extends('site.index')
@section('title',$tag_data->slug)
@section('content')
    <style>
        table{
            border: none !important;
        }
    </style>
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">$tag_data->slug</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">$tag_data->slug</li>
            </ul>
        </div>
    </div>
    <div class="box-vote-content">
        @if(isset($tag_data) && $tag_data != null)
        <div class="banner-inner">
            <div class="container">
                <h2>{{$tag_data->name}}</h2>
            </div>

            @if(count($tag_data->blogs) == 0)
            <h3 class="text-center">لا توجد ننائج</h3>
            @else
            <table class="table" style=" width: 600px;margin: 0 auto;">
                @php
                $i=0;
                @endphp

                @forelse($tag_data->blogs as $blog)

                <tr class="lead">
                    <td>{{++$i}}</td>
                    <td class="text-center"> <td><a href="{{route('post.show',$blog->slug)}}">{{strlen($blog->title)>50?substr($blog->title,0,strpos($blog->title,' ',50)).'...': $blog->title}}</a></td>
                </tr>
                @empty
                    <li><h3 style="text-align: center">لا يوجد إقتراحات لعرضها حاليا</h3></li>
                @endforelse

            </table>
            @endif
        </div>
          @endif

    </div>

    <script src="{{asset('site/js/classie.js')}}"></script>
    <script src="{{asset('site/js/uisearch.js')}}"></script>
    <script>
        new UISearch(document.getElementById('sb-search'));
    </script>

@endsection
