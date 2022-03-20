@extends('admin.index')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/icon.css')}}">
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/icon.css')}}">
    <script type="text/javascript" src="{{asset('admins/easyui/jquery.easyui.min.js')}}"></script>

    <div id="middleContent">
        <a href="{{route('site_content')}}" class="button sub inlineBlock rnd3 lightTextShadow">
            <span>المحتوى</span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">تحديث المحتوى </div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('site_content.update',$content->id)}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث المحتوى </legend>
                        <input type="hidden" name="id" value="{{$content->id}}" />

                        <label class="label">العنوان :</label>
                        <input id="name" class="textBox med rnd5" name="title" value="{{old('title',$content->title)}}" />
                        @error('title')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">قسم الواجهة الأمامية :</label>
                        <select size="1" name="site_section_id" class="select med rnd5">
                            @foreach ($sections as $section)
                                <option value="{{$section->id}}" @if($section->id==old('site_section_id',$content->site_section_id)) selected @endif>{{$section->name}}</option>
                            @endforeach
                        </select>
                        @error('site_section_id')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label class="label">الموضوع :</label>
                        <textarea  name="body" id="textEditor" rows="6" cols="0" class="textArea lrg rnd5">{{old('body',$content->body)}}</textarea><br /><br />
                        @error('body')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if($content->active==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('content') !!}
                        @error('g-recaptcha-response')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
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
