@extends('admin.index')
@section('stylesheets')
    <style>
        img{
            margin: 5px 0;
        }
    </style>
@endsection
@section('content')

    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">صور الموقع</div>
            <div class="content">
                <a href="{{route('site.images.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>أضافة أو تحديث صور الموقع</span>
                </a>
                @if(session()->has('success_msg'))
                    <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                    <br />
                @endif
                <br /><br /><br />
                @if(count($site_images)==0)
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table  class="boxStyle" style="width: 100%; font-size: 15px" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الصفحة</th>
                            <th>الصورة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row=0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($site_images as $site_image)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td>{{$site_image->site_section->name}}</td>
                                <td>
                                    @if($site_image->image != "" && file_exists("site/img/" . $site_image->image))
                                        <img src="{{'../../site/img/'.$site_image->image}}" width="300" height="150" />
                                    @else
                                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
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
