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
        <div class="title lightTextShadow">الكورسات</div>
        <div class="content">
            <a href="{{route('course.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>كورس جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            <a href="{{route('video.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الفيديوهات</span>
            </a>
            <a href="{{route('course.payable')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الكورسات المدفوعة</span>
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
                    <th>عدد الفيديوهات</th>
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
                    <td><a href="{{route('video.index',$course->id)}}">{{$course->videos_count}} فيديو</a></td>
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
