@extends('admin.index')
@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">{{$course->name??'الفيديوهات'}}</div>
        <div class="content">
            <a href="{{route('videos.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>فيديو جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            <a href="{{route('courses.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الكورسات</span>
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
            @if(count($videos)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>اسم الفيديو</th>
                    <th>أستاذ المادة</th>
                    @if(!isset($course))
                    <th>الكورس</th>
                    @endif
                    <th>الصورة</th>
                    <th>التاريخ</th>
                    <th>الترتيب</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($videos as $video)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td><a href="{{route('videos.show',$video->id)}}">{{$video->name}}</a></td>
                    <td>{{$video->author}}</td>
                    @if(!isset($course))
                    <td>{{$video->course->name}}</td>
                    @endif
                    <td>
                        @if($video->image != "" && file_exists("uploads/v_images/" . $video->image))
                        <img src="{{'../../../uploads/v_images/'.$video->image}}" width="80" height="50" />
                        @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                    </td>
                    <td><span dir="ltr">{{$video->created_at->diffForHumans()}}</span></td>
                    <td class="align-center">
                        <a href="{{route('videos.sort',['direction'=>'up','video'=>$video->id])}}" ><img src="{{asset('admins/images/up.png')}}" title="أعلى" alt="up"/></a>
                        <a href="{{route('videos.sort',['direction'=>'down','video'=>$video->id])}}" ><img src="{{asset('admins/images/down.png')}}" title="أسفل" alt="down"/></a>
                    </td>
                    <td>
                        @if ($video->active == 0)

                        <a title="تفعيل " class="tool boxStyle"
                           href="{{route('videos.activate',$video->id)}}"><img
                                alt="تفعيل"
                                src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                        <a title="الغاء تفعيل " class="tool boxStyle"
                           href="{{route('videos.deactivate',$video->id)}}"><img
                                alt="الغاء تفعيل"
                                src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('videos.edit',$video->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                            <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                            <form method="post" action="{{route('videos.destroy',$video->id)}}" style="display: none">
                                @csrf
                                @method('delete')
                            </form>
                    </td>
                </tr>
                @php
                $counter++
                @endphp
                @endforeach


                </tbody>
            </table>
                <div class="pager">
                    {!! $videos->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
