@extends('admin.index')
@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">الكورسات</div>
        <div class="content">
            <a href="{{route('course.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>كورس جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            <a href="{{route('course.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الكورسات المجانية</span>
            </a>
            <a href="{{route('c_applicant.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>المتقدمين للكورسات</span>
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
            @if(count($courses)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>اسم الكورس</th>
                    <th>عدد الساعات</th>
                    <th>رسوم الكورس</th>
                    <th>عدد المتقدمين</th>
                    <th>الأرباح</th>
                    <th>الرخصة</th>
                    <th>الصورة</th>
                    <th>التاريخ</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($courses as $course)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td>{{strlen($course->name)>50?substr($course->name,0,strpos($course->name,' ',50)).'...': $course->name}}</td>
                    <td>{{$course->duration}} ساعة</td>
                    <td>{{$course->price}} </td>
                    <td><a href="{{route('c_applicant.index',$course->id)}}">{{$course->applicants_count}} متقدم</a></td>
                    <td>{{$course->applicants_count * $course->price}} </td>
                    <td>{{$course->licence}}</td>
                    <td>
                        @if($course->image != "" && file_exists("uploads/courses/" . $course->image))
                        <img src="{{'../../../uploads/courses/'.$course->image}}" width="80" height="50" />
                        @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                    </td>
                    <td>{{ date("g:i a F j, Y ", strtotime($course->created_at))}}</td>

                    <td title="">
                        @if ($course->active == 0)

                        <a title="تفعيل " class="tool boxStyle"
                           href="{{route('course.activate',$course->id)}}"><img
                                alt="تفعيل"
                                src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                        <a title="الغاء تفعيل " class="tool boxStyle"
                           href="{{route('course.deactivate',$course->id)}}"><img
                                alt="الغاء تفعيل"
                                src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('course.edit',$course->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                        <a title="حذف " class="tool boxStyle" href="{{route('course.delete',$course->id)}}" class="delete_confirm"  onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف"  /></a>
                    </td>
                </tr>
                @php
                $counter++
                @endphp
                @endforeach


                </tbody>
            </table>
                <div class="pager">
                    {!! $courses->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
