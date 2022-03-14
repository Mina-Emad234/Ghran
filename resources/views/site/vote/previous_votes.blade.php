@extends('site.index')
@section('title','إستطلاعات الرأي السابقة')
@section('content')
<div id="middleContent">
    <!-- Bread Crumb Start -->
    <div class="breadCrumb">
        <h3>استطلاعات الرأي السابقة</h3>
    </div>
    <!-- Bread Crumb End -->
    @if($votes  != null)

    <div class="block lrg">
        <div class="box-vote-content text">
            <ul class="voting-results">
                @foreach($votes as $vote)
                <li><span class="answer">{{$vote->question}}</span><a style="padding-right: 50px" href="{{route('vote.result',$vote->id)}}">نتائج الإستطلاع الحالي</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    @else
    <p class="notice error">عفوا لا يوجد أى تصويت حتى الان</p>
    @endif
</div>
@endsection
