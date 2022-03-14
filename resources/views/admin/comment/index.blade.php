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
            <div class="title lightTextShadow">قائمة التعليقات</div>
            <div class="content">
                <a href="{{route('blog.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المقالات</span>
                </a>
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
                @if(count($comments) == 0)
                <br/>
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th >العنوان</th>
                            <th >البريد</th>
                            <th >التعليق</th>
                            <th >المنشور</th>
                            <th >التاريخ</th>
                            <th >خيارات</th>


                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row = 0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($comments as $comment)
                        <tr
                            @if($counter % 2 == 1)
                                 class='odd'
                            @endif >
                            <td class="align-center">{{ $counter }}</td>
                            <td class="align-center">{{ ucwords($comment->writer) }}</td>
                            <td class="align-center">{{ $comment->email }}</a></td>
                            <td class="align-center">{{ substr($comment->body,0,50).'.' }}</td>
                            <td class="align-center">{{ substr($comment->blog->title,0,50).'.' }}</td>
                            <td>{{ date("g:i a F j, Y ", strtotime($comment->created_at))}}</td>

                            <td class="align-center">
                                @if ($comment->active == 0)

                                    <a title="تفعيل " class="tool boxStyle"
                                       href="{{route('comment.activate',$comment->id)}}"><img
                                            alt="تفعيل"
                                            src="{{asset('admins/images/icons/active.png')}}"></a>
                                @else
                                    <a title="الغاء تفعيل " class="tool boxStyle"
                                       href="{{route('comment.deactivate',$comment->id)}}"><img
                                            alt="الغاء تفعيل"
                                            src="{{asset('admins/images/icons/deactive.png')}}"></a>
                                @endif

                                <a href="{{route('comment.delete',$comment->id)}}" class="delete_confirm"  title="حذف" onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/del.png')}}" width="16" height="16" title="" alt="حذف"  /></a>
                            </td>
                        </tr>
                        @php
                        $counter++;
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pager">
                        {!! $comments->links("pagination::bootstrap-4") !!}
                    </div>
            </div>
        </div><!-- Data Grid End -->
    </div><!-- Data Grid End -->
    @endif

@endsection
