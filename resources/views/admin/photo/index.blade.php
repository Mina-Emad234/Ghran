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
            <a href="{{route('photo.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>إضافة صور جديدة<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
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
            @if(count($photos)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>القسم</th>
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
                @foreach($photos as $photo)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td>{{$photo->album->name}}</td>
                    <td>
                        @if($photo->photo != "" && file_exists("uploads/photos/" . $photo->photo))
                        <img src="{{'../../../uploads/photos/'.$photo->photo}}" width="80" height="50" />
                        @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                    </td>
                    <td>{{ date("g:i a F j, Y ", strtotime($photo->created_at))}}</td>
                    <td class="align-center">
                        <a href="{{route('photo.sort',['direction'=>'up','id'=>$photo->id])}}" ><img src="{{asset('admins/images/up.png')}}" title="أعلى" alt="up"/></a>
                        <a href="{{route('photo.sort',['direction'=>'down','id'=>$photo->id])}}" ><img src="{{asset('admins/images/down.png')}}" title="أسفل" alt="down"/></a>
                    </td>
                    <td title="">
                        @if ($photo->active == 0)

                        <a title="تفعيل " class="tool boxStyle"
                           href="{{route('photo.activate',$photo->id)}}"><img
                                alt="تفعيل"
                                src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                        <a title="الغاء تفعيل " class="tool boxStyle"
                           href="{{route('photo.deactivate',$photo->id)}}"><img
                                alt="الغاء تفعيل"
                                src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                        <a title="حذف " class="tool boxStyle" href="{{route('photo.delete',$photo->id)}}" class="delete_confirm"  onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف"  /></a>
                    </td>
                </tr>
                @php
                $counter++
                @endphp
                @endforeach


                </tbody>
            </table>
                <div class="pager">
                    {!! $photos->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
