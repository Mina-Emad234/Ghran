@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">الإعدادات</div>
            <div class="content">
                <a href="{{route('setting.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>أضافة أو تحديث إعداد</span>
                </a>
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                <br /><br /><br />
                @if(count($settings)==0)
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table  class="boxStyle" style="width: 100%; font-size: 15px" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>القيمة</th>
                            <th>العمليات</th>
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
                                <td>{{$setting->key}}</td>
                                <td>
                                    @php
                                        $value=json_decode($setting->value);
                                    @endphp
                                    @if(is_array($value))
                                        {{implode(', ',$value)}}
                                    @else
                                        {{$setting->value}}
                                    @endif
                                </td>
                                <td>
                                    <a title="تعديل البيانات" class="tool boxStyle" href="{{route('setting.edit',$setting->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                                    <a title="حذف " class="tool boxStyle" href="{{route('setting.delete',$setting->id)}}" onclick="return confirm('هل تريد حذف هذا العنصر؟');"><img alt="" src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" > </a>
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
