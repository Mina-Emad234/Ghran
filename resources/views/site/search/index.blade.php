@extends('site.index')
@section('title',$search??"البحث")
@section('content')
    <style>
        table{
            border: none !important;
        }
    </style>
    <div id="sb-search" class="sb-search" style="width: 400px; margin: 20px auto">
        <form action="{{route('search.index')}}" method="get" >
            <div class="form-group">
                <input class="sb-search-input form-control" placeholder="أدخل مصطلح البحث هنا..." type="text" value="" name="search" id="search">
            </div>
            <div class="form-group">
                <input class="sb-search-submit btn btn-custom center-block" type="submit" value="بحث">
            </div>
        </form>
    </div>
    <div class="box-vote-content">
        @if(isset($search) && $search != null)
        <div class="banner-inner">
            <div class="container">
                <h2>نتائج البحث "{{ $search }}"</h2>
            </div>
            @if(count($results[0])==0)
            <h3 class="text-center">لا توجد ننائج</h3>
            @else
            <table class="table" style=" width: 600px;margin: 0 auto;">
                @php
                $i=0;
                @endphp
                @foreach($results as $blogs)
                @foreach($blogs as $blog)

                <tr class="lead">
                    <td>{{ ++$i }}</td>
                    <td class="text-center"> <td><a href="{{route('post.show',$blog->slug)}}">{{strlen($blog->title)>50?substr($blog->title,0,strpos($blog->title,' ',50)).'...': $blog->title}}</a></td>
                </tr>

                @endforeach
                @endforeach
                @endif
                @endif
            </table>
        </div>
    </div>


    <script src="{{asset('site/js/classie.js')}}"></script>
    <script src="{{asset('site/js/uisearch.js')}}"></script>
    <script>
        new UISearch(document.getElementById('sb-search'));
    </script>

@endsection
