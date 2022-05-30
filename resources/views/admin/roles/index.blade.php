@extends('admin.index')
@section('content')

<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">قائمة الصلاحيات</div>
        <div class="content">
            <a href="{{route('roles.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>إضافة صلاحية جديدة<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif
            @if(session()->has('success_msg'))
                <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                <br />
            @endif
            @if(count($roles)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>الاسم</th>
                    <th>الصلاحيات</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($roles as $role)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td>{{$role->name}}</a></td>
                    <td style="max-width: 500px">
                        @foreach ($array=config('global.permissions') as $name => $value)
                            @if(!in_array($name,$role->permissions))
                                @php
                                    unset($array[$name])
                                @endphp
                            @endif
                         @endforeach
                        {{implode(' - ', $array)}}
                    </td>

                    <td title="">
                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('roles.edit',$role->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                        <form method="post" action="{{route('roles.destroy',$role->id)}}" style="display: none">
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
                    {!! $roles->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->
@endif
@endsection
