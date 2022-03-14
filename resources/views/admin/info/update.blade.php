@extends('admin.index')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('admin/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/easyui/themes/icon.css')}}">
    <script type="text/javascript" src="{{asset('admin/easyui/jquery.easyui.min.js')}}"></script>

    <div id="middleContent">
        <a href="{{route('info.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة المعلومات </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة معلومة جديد </div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('info.update',$info->id)}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة  معلومة جديد</legend>
                        <input type="hidden" name="id" value="{{$info->id}}">

                        <label class="label">المعلومة :</label>
                        <textarea  name="body" id="textEditor" rows="6" cols="0" class="textArea lrg rnd5">{{$info->body}}</textarea><br /><br />
                        @error('body')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if($info->active==1) checked @endif/>
                        <br />
                        <div class="center">
                            <input id="submit" type="submit" value="أدخل" class="button sml inlineBlock rnd5 drkTextShadow" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


@endsection
