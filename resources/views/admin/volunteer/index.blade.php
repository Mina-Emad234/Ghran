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
    <!-- Data Grid Start -->
    <div id="middleContent">
        <div class="block">
            <div class="title lightTextShadow">الفريق التطوعي</div>
            <div class="content">
                <!-- Notification boxes -->
                <a href="{{route('scouts.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الكشافة</span>
                </a>
                <a href="{{route('media.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المركز الإعلامي</span>
                </a>
                <br/>
                @if(session()->has('error_msg'))
                    <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                    <br />
                @endif
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                @if(count($teams)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد رسائل<p>
                @else
                <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                    <tr>
                        <th>مسلسل</th>
                        <th>الحالة</th>
                        <th>الإسم</th>
                        <th>العنوان</th>
                        <th>البريد الإلكتروني</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>


                    @php
                        $row=0;
                        $counter = $row + 1;
                    @endphp
                    @foreach ($teams as $team) :
                    @if($team->read == 1)
                        @php
                            $ImgUser = "msg_open";
                            $Reded = "قرأت";
                        @endphp
                    @else
                        @php
                            $ImgUser = "msg_close";
                            $Reded = "لم تقرأ";
                        @endphp
                    @endif
                    <tr
                        @if($counter % 2 == 1)
                            class='odd'
                        @endif
                        >
                        <td class="align-center">{{$counter}}</td>
                        <td class="align-center"><img title="{{$Reded}}" src="{{asset('admins/images/'.$ImgUser.'.png')}}"  /></td>
                        <td>{{$team->name}}</td>
                        <td>{{$team->address}}</td>
                        <td>{{$team->email}}</td>
                        <td class="align-center">
                            <a href="{{route('volunteer.read',$team->id)}}"> <img title="قراءة محتوى الرسالة" src="{{asset('admins/images/balloon.gif')}}"  /></a>&nbsp;&nbsp; | &nbsp;&nbsp;
                            <a href="{{route('volunteer.delete',$team->id)}}" onclick="return confirm('هل تريد حذف هذا العنصر؟')"><img src="{{asset('admins/images/del.png')}}" width="16" height="16" title="حذف" alt="حذف"  /></a>
                        </td>
                    </tr>
                    @php
                    $counter++;
                    @endphp
                    @endforeach


                    </tbody>
                </table>
                <div class="pager">
                    {!! $teams->links("pagination::bootstrap-4") !!}
                </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div><!-- Data Grid End -->


@endsection
