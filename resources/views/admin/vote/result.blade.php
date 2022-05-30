@extends('admin.index')
@section('stylesheets')
    <style>
        table{
            font-size: 13px;
        }
    </style>
@endsection
@section('content')

    <div id="middleContent">

        <!-- Data Grid Start -->
        <div class="block">
            <div class="title lightTextShadow">نتائج إستفتاء-->{{$vote->question}}</div>

            <div class="content">
                <a href="{{route('questions.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>اضف إستفتاء<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
                </a>
                <a href="{{route('questions.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الإستفتاءات</span>
                </a>


                <!-- Notification boxes -->
                @if($vote->answers_count == 0)
                    <br/>
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>إجمالي العدد</th>
                            <th>{{$vote->answer1}}</th>
                            <th>{{$vote->answer2}}</th>
                            <th>{{$vote->answer3}}</th>
                            <th>{{$vote->answer4}}</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="align-center">{{$vote->answers_count}}</td>
                                <td>{{$answer1 * 100/$vote->answers_count}}%</td>
                                <td>{{$answer2 * 100/$vote->answers_count}}%</td>
                                <td>{{$answer3 * 100/$vote->answers_count}}%</td>
                                <td>{{$answer4 * 100/$vote->answers_count}}%</td>

                        </tbody>
                    </table>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>



@endsection
