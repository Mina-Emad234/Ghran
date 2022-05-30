@extends('admin.index')
@section('content')

    <div id="middleContent">

        <!-- Data Grid Start -->
        <div class="block">
            <div class="title lightTextShadow">{{$blog->title??'قائمة التعليقات'}}</div>
            <div class="content">
                <a href="{{route('blogs.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
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
                            @if(!isset($blog))
                            <th >المنشور</th>
                            @endif
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
                            <td class="align-center" style="max-width: 300px; word-break: break-all">{{ $comment->body }}</td>
                            @if(!isset($blog))
                            <td class="align-center">{{ substr($comment->blog->title,0,50).'.' }}</td>
                            @endif
                            <td><span dir="ltr">{{$comment->created_at->diffForHumans()}}</span></td>

                            <td class="align-center">
                                @if ($comment->active == 0)

                                    <a title="تفعيل " class="tool boxStyle"
                                       href="{{route('comments.activate',$comment->id)}}"><img
                                            alt="تفعيل"
                                            src="{{asset('admins/images/icons/active.png')}}"></a>
                                @else
                                    <a title="الغاء تفعيل " class="tool boxStyle"
                                       href="{{route('comments.deactivate',$comment->id)}}"><img
                                            alt="الغاء تفعيل"
                                            src="{{asset('admins/images/icons/deactive.png')}}"></a>
                                @endif

                                <a href="{{route('comments.delete',$comment->id)}}" class="delete_confirm"  title="حذف" onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/del.png')}}" width="16" height="16" title="" alt="حذف"  /></a>
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
