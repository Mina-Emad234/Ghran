@extends('admin.index')
@section('content')
    <!-- Data Grid Start -->
    <div id="middleContent">
        <div class="block">
            <div class="title lightTextShadow">الكشافة</div>
            <a href="{{route('media.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>المركز الإعلامي</span>
            </a>
            <a href="{{route('volunteer.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الفريق التطوعي</span>
            </a>
            <div class="content">
                <!-- Notification boxes -->
                @if(session()->has('error_msg'))
                    <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                    <br />
                @endif
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                <br/>
                @if(count($scouts)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد رسائل<p>
                @else
                <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                    <tr>
                        <th>مسلسل</th>
                        <th>الحالة</th>
                        <th>الاسم </th>
                        <th>إسم الاب </th>
                        <th>الهوايات</th>
                        <th>البريد الإلكتروني</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>


                    @php
                        $row=0;
                        $counter = $row + 1;
                    @endphp
                    @foreach ($scouts as $scout) :
                    @if($scout->read == 1)
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
                        <td>{{$scout->name}}</td>
                        <td>{{$scout->paren_name}}</td>
                        <td>{{$scout->interests}}</td>
                        <td>{{$scout->email}}</td>
                        <td class="align-center">
                            <a href="{{route('scouts.read',$scout->id)}}"> <img title="قراءة محتوى الرسالة" src="{{asset('admins/images/balloon.gif')}}"  /></a>&nbsp;&nbsp; | &nbsp;&nbsp;
                            <a href="{{route('scouts.delete',$scout->id)}}" onclick="return confirm('هل تريد حذف هذا العنصر؟')"><img src="{{asset('admins/images/del.png')}}" width="16" height="16" title="حذف" alt="حذف"  /></a>
                        </td>
                    </tr>
                    @php
                    $counter++;
                    @endphp
                    @endforeach


                    </tbody>
                </table>
                <div class="pager">
                    {!! $scouts->links("pagination::bootstrap-4") !!}
                </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div><!-- Data Grid End -->


@endsection
