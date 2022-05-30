@extends('site.index')
@section('title',$vote->question)
@section('content')
    <div id="middleContent">
        <!-- Bread Crumb Start -->
        <div class="breadCrumb">
            <h3>نتائج استطلاع الرأي</h3>
        </div>
        <!-- Bread Crumb End -->
        @if($vote->answers_count != 0 )
        <div class="block lrg">
            <div class="lead">{{$vote->question}}</div>
            <div class="text-info">عدد من شارك في الاستطلاع حتى الآن {{$vote->answers_count}} زائر</div>
            <div class="box-vote-content text">

                    <!-- النتائج هي النسبة المئوية × 1.4 -->
                <p><span class="answer">{{$vote->answer1}}</span> <span class="precent">{{$answer1 * 100/$vote->answers_count}}%</span><span class="indicator"></span></p>

                <p><span class="answer">{{$vote->answer2}}</span> <span  class="precent">{{$answer2 * 100/$vote->answers_count}}%</span><span class="indicator"></span></p>

                <p><span class="answer">{{$vote->answer3}}</span> <span  class="precent">{{$answer3 * 100/$vote->answers_count}}%</span><span class="indicator"></span></p>

                <p><span class="answer">{{$vote->answer4}}</span> <span  class="precent">{{$answer4 * 100/$vote->answers_count}}%</span><span class="indicator"></span></p>


            </div>
        </div>

        @else
        <p class="notice error">عفوا لا يوجد أى نتائج لهذا التصويت حتى الان</p>
        @endif
    </div>
@endsection
