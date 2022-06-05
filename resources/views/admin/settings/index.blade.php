@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">الإعدادات</div>
            <div class="content">
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                <br /><br /><br />
                @if(count($settings)==0)
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table dir="ltr" class="boxStyle" style="width: 100%; font-size: 15px" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>key</th>
                            <th>value</th>
                            <th>operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row=0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($settings as $setting)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td style="max-width: 350px">{{ucfirst(trim(substr($setting->key,4),'.'))}}</td>
                                <td>
                                    @if(strlen($setting->value)>50)
                                        {{substr($setting->value,0,50).'.....'}}
                                    @else
                                        {{$setting->value}}
                                    @endif
                                </td>
                                <td>
                                    @if($setting->trashed())
                                        <a title="إسترجاع البيانات" class="tool boxStyle" href="{{route('settings.restore',$setting->id)}}"  ><img src="{{asset('admins/images/icons/restore.png')}}" alt="إسترجاع" width="20" /></a>
                                    @else
                                        <a title="تعديل البيانات" class="tool boxStyle" href="{{route('settings.edit',$setting->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر، قد يؤثر هذا سلبيا على توقف خدمات معينة في الموقع مما يؤدي إلى حدوث أعطال؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                                        <form method="post" action="{{route('settings.destroy',$setting->id)}}" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
