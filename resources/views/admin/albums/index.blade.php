@extends('admin.index')

@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">أقسام الصور</div>
        <div class="content">
            <a href="{{route('albums.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>قسم جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif
            @if(session()->has('success_msg'))
                <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                <br />
            @endif
            @if(count($albums)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>القسم</th>
                    <th>الصورة</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($albums as $album)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td><a href="{{route('album.photos',$album->slug)}}">{{$album->name}}</a></td>
                    <td >
                        @if($album->image != "" && file_exists("uploads/albums/" . $album->image))
                        <img src="{{asset('uploads/albums/'.$album->image)}}" width="80" height="50" />
                        @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                    </td>

                    <td title="">
                        @if ($album->status == 0)

                            <a  title="تفعيل " class="tool boxStyle"
                                href="{{route('albums.activate',$album->id)}}"><img
                                    alt="تفعيل"
                                    src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                            <a  title="الغاء تفعيل " class="tool boxStyle"
                                href="{{route('albums.deactivate',$album->id)}}"><img
                                    alt="الغاء تفعيل"
                                    src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('albums.edit',$album->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                        <form method="post" action="{{route('albums.destroy',$album->id)}}" style="display: none">
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
                    {!! $albums->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
