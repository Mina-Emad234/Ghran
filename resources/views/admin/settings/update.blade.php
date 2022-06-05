@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('settings.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة الإعدادات</span>
        </a>
        <div class="block">
            <div align="center" class="title lightTextShadow">{{ucfirst(trim(substr($setting->key,4),'.'))}}</div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('settings.update',$setting->id)}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle"> تعديل إعداد</legend>
                        <label for="chk1" class="label">القيمة</label>
                        <textarea id="chk1" class=" med rnd5" name="value" cols="80" rows="10">{{old('value',$setting->value)}}</textarea>
                        @error('value')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        {!! RecaptchaV3::field('settings') !!}
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
