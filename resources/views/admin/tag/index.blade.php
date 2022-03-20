@extends('admin.index')
@section('content')
    <div id="middleContent">

        <!-- Data Grid Start -->
        @if(session()->has('error_msg'))
            <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
            <br />
        @endif
        @if(session()->has('success_msg'))
            <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
            <br />
        @endif
        <div class="block">
            <div class="title lightTextShadow">قائمة كلمات البحث </div>

            <div class="content">
                <a href="{{route('tag.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>اضف كلمة بحث<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
                </a>


                <!-- Notification boxes -->

                @if(count($tags) == 0)
                    <br/>
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th>كلمة البحت</th>
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
                        @foreach($tags as $tag)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{ date("g:i a F j, Y ", strtotime($tag->created_at))}}</td>
                                <td class="align-center">
                                    <a href="{{route('tag.sort',['direction'=>'up','id'=>$tag->id])}}" ><img src="{{asset('admins/images/up.png')}}" title="أعلى" alt="up"/></a>
                                    <a href="{{route('tag.sort',['direction'=>'down','id'=>$tag->id])}}" ><img src="{{asset('admins/images/down.png')}}" title="أسفل" alt="down"/></a>
                                </td>
                                <td title="">
                                    @if($tag->active == 1)
                                        <a  title="الغاء تفعيل " class="tool boxStyle" href="{{route('tag.deactivate',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/deactive.png')}}"></a>
                                    @else
                                        <a  title="تفعيل " class="tool boxStyle" href="{{route('tag.activate',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/active.png')}}"></a>
                                    @endif

                                    <a title="تعديل البيانات"  class="tool boxStyle" href="{{route('tag.edit',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل"> </a>
                                    <a title="حذف " class="tool boxStyle" href="{{route('tag.delete',$tag->id)}}" onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img alt="" src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" > </a>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pager">
                        {!! $tags->links("pagination::bootstrap-4") !!}
                    </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>



@endsection
