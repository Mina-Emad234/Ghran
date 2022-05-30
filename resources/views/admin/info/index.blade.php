@extends('admin.index')
@section('content')

    <div id="middleContent">

        <!-- Data Grid Start -->
        <div class="block">
            <div class="title lightTextShadow">قائمة المعلومات </div>

            <div class="content">
                <a href="{{route('info.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>اضف معلومة<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
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
                @if(count($infos) == 0)
                    <br/>
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th>المعلومة</th>
                            <th >التاريخ</th>
                            <th>ترتيب</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row=0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($infos as $info)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td>{!!$info->body!!}</td>
                                <td><span dir="ltr">{{$info->created_at->diffForHumans()}}</span></td>
                                <td class="align-center">
                                    <a href="{{route('info.sort',['info'=>$info->id,'direction'=>'up',])}}" ><img src="{{asset('admins/images/up.png')}}" title="أعلى" alt="up"/></a>
                                    <a href="{{route('info.sort',['info'=>$info->id,'direction'=>'down',])}}" ><img src="{{asset('admins/images/down.png')}}" title="أسفل" alt="down"/></a>
                                </td>
                                <td>
                                    @if($info->active == 1)
                                        <a  title="الغاء تفعيل " class="tool boxStyle" href="{{route('info.deactivate',$info->id)}}"><img alt="" src="{{asset('admins/images/icons/deactive.png')}}"></a>
                                    @else
                                        <a  title="تفعيل " class="tool boxStyle" href="{{route('info.activate',$info->id)}}"><img alt="" src="{{asset('admins/images/icons/active.png')}}"></a>
                                    @endif

                                    <a title="تعديل البيانات"  class="tool boxStyle" href="{{route('info.edit',$info->id)}}"><img alt="" src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل"> </a>
                                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟')"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                                    <form method="post" action="{{route('info.destroy',$info->id)}}" style="display: none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pager">
                        {!! $infos->links("pagination::bootstrap-4") !!}
                    </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>



@endsection
