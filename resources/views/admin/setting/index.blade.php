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
                                <td style="max-width: 350px">{{$setting->key}}</td>
                                <td>
                                    @if(strlen($setting->value)>50)
                                        {{substr($setting->value,0,50).'.....'}}
                                    @else
                                        {{$setting->value}}
                                    @endif
                                </td>
                                <td>
                                    <a title="تعديل البيانات" class="tool boxStyle" href="{{route('setting.edit',$setting->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
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
