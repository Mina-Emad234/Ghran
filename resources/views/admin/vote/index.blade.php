@extends('admin.index')
@section('content')
    <style>
        .pagination li{
            list-style-type: none;
            display: inline;
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            jQuery("#operation").change(function() {

                var len = jQuery("#group:checked").length;
                if (len < 1) {
                    alert("لم تقم باختيار أى عنصر");
                    jQuery(".defaultOpt").attr("selected", "selected");
                    return false;
                } else {
                    if (jQuery("option.delete").is(":selected")) {
                        var answer = confirm('هل أنت متأكد من حذف هذه العناصر؟');
                        if (answer == false) {
                            jQuery(".defaultOpt").attr("selected", "selected");
                            return false;
                        }
                    }
                    jQuery("#form").submit();
                }
            });
        });
    </script>
    <div id="middleContent">

        <!-- Data Grid Start -->
        <div class="block">
            <div class="title lightTextShadow">قائمة الإستفتاءات </div>

            <div class="content">
                <a href="{{route('v_question.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>اضف إستفتاء<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
                </a>


                <!-- Notification boxes -->
                @if(session()->has('error_msg'))
                    <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                    <br />
                @endif
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                @if(count($votes) == 0)
                    <br/>
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th>السؤال</th>
                            <th>الإجابة الأولى</th>
                            <th>الإجابة الثانية</th>
                            <th>الإجابة الثالثة</th>
                            <th>الإجابة الرابعة</th>
                            <th>النتائج</th>
                            <th>التاريخ</th>
                            <th>ترتيب</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row=0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($votes as $vote)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td>{{$vote->question}}</td>
                                <td>{{$vote->answer1}}</td>
                                <td>{{$vote->answer2}}</td>
                                <td>{{$vote->answer3}}</td>
                                <td>{{$vote->answer4}}</td>
                                <td><a href="{{route('v_question.result',$vote->id)}}">عرض النتائج</a></td>
                                <td>{{ date("g:i a F j, Y ", strtotime($vote->created_at))}}</td>
                                <td class="align-center">
                                    <a href="{{route('v_question.sort',['direction'=>'up','id'=>$vote->id])}}" ><img src="{{asset('admins/images/up.png')}}" title="أعلى" alt="up"/></a>
                                    <a href="{{route('v_question.sort',['direction'=>'down','id'=>$vote->id])}}" ><img src="{{asset('admins/images/down.png')}}" title="أسفل" alt="down"/></a>
                                </td>
                                <td title="">
                                    @if($vote->active == 1)
                                        <a  title="الغاء تفعيل " class="tool boxStyle" href="{{route('v_question.deactivate',$vote->id)}}"><img alt="" src="{{asset('admins/images/minus-circle.gif')}}"></a>
                                    @else
                                        <a  title="تفعيل " class="tool boxStyle" href="{{route('v_question.activate',$vote->id)}}"><img alt="" src="{{asset('admins/images/icons/active.png')}}"></a>
                                    @endif

                                    <a title="تعديل البيانات"  class="tool boxStyle" href="{{route('v_question.edit',$vote->id)}}"><img alt="" src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل"> </a>
                                    <a title="حذف " class="tool boxStyle" href="{{route('v_question.delete',$vote->id)}}" onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img alt="" src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" > </a>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pager">
                        {!! $votes->links("pagination::bootstrap-4") !!}
                    </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>



@endsection
