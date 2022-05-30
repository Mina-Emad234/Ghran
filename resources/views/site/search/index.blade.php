@extends('site.index')
@section('title',$search??"البحث")
@section('stylesheets')
    <style>
        table{
            border: none !important;
        }
    </style>
@endsection
@section('content')

    <div id="sb-search" class="sb-search" style="width: 400px; margin: 20px auto">
        <form action="{{route('search')}}" method="get" >

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
            @if(count($search_data)==0)
            <h3 class="text-center">لا توجد ننائج</h3>
            @else
            <table class="table" style=" width: 600px;margin: 0 auto;">
                @php
                $i=0;
                @endphp
                @foreach($search_data as $data)

                <tr class="lead">
                    <td>{{ ++$i }}</td>
                    <td class="text-center"> <td><a href="{{url($data->link)}}">{{$data->title}}</a></td>
                </tr>

                @endforeach
                @endif
            </table>
                <div align="center">
                    {!! $search_data->appends(['sort' => 'science-stream'])->links("pagination::bootstrap-4") !!}
                </div>
        </div>
@endif
    </div>
@endsection
@push('scripts')
    <script src="{{asset('site/js/classie.js')}}"></script>
    <script src="{{asset('site/js/uisearch.js')}}"></script>
    <script>
        new UISearch(document.getElementById('sb-search'));
    </script>
    @endpush
