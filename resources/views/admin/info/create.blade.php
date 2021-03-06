@extends('admin.index')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/icon.css')}}">
@endsection
@section('content')
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
                <form method="POST" action="{{route('info.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة  معلومة جديد</legend>


                        <label class="label">المعلومة :</label>
                        <textarea  name="body" id="textEditor" rows="6" cols="0" class="textArea lrg rnd5">{{old('body')}}</textarea><br /><br />
                        @error('body')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active')==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('info') !!}
                        @error('g-recaptcha-response')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
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
@push('sripts')
    <script type="text/javascript" src="{{asset('admins/easyui/jquery.easyui.min.js')}}"></script>
@endpush
