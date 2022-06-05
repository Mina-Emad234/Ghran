@extends('admin.index')
@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">أقسام الواجهة الأمامية</div>
        <div class="content">
            <a href="{{route('site.sections.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
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
            @if(count($sections)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>القسم</th>
                    <th>النوع</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($sections as $section)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td>{{$section->name}}</td>
                    <td>{{$section->section_type}}</td>
                    <td title="">
                        @if($section->trashed())
                            <a title="إسترجاع البيانات" class="tool boxStyle" href="{{route('site.sections.restore',$section->id)}}"  ><img src="{{asset('admins/images/icons/restore.png')}}" alt="إسترجاع" width="20" /></a>
                        @else
                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('site.sections.edit',$section->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر سيؤدي ه1ا إلى وجود أعطال في الواجهة الأمامية للمستخدم؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                        <form method="post" action="{{route('site.sections.destroy',$section->id)}}" style="display: none">
                        @csrf
                        @method('delete')
                        </form>
                        @endif
                    </td>
                </tr>
                @php
                $counter++
                @endphp
                @endforeach


                </tbody>
            </table>
                <div class="pager">
                    {!! $sections->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
