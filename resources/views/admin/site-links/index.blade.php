@extends('admin.index')
@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">الروابط</div>
        <div class="content">
            <a href="{{route('site.links.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>رابط جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
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
            @if(count($links)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>الاسم</th>
                    <th>الرابط</th>
                    <th>قسم الواجهة الأمامية</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($links as $link)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td>{{$link->name}}</td>
                    <td dir="ltr" align="right">{{$link->link??'لا يوجد'}}</td>
                    <td>{{$link->site_section->name}}</td>

                    <td title="">
                        @if ($link->status == 0)

                        <a title="تفعيل " class="tool boxStyle"
                           href="{{route('site.links.activate',$link->id)}}"><img
                                alt="تفعيل"
                                src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                        <a title="الغاء تفعيل " class="tool boxStyle"
                           href="{{route('site.links.deactivate',$link->id)}}"><img
                                alt="الغاء تفعيل"
                                src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('site.links.edit',$link->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                            <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                            <form method="post" action="{{route('site.links.destroy',$link->id)}}" style="display: none">
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
                    {!! $links->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->

@endif
@endsection
