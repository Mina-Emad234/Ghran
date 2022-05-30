@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('tags.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة الكلمات </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة كلمة بحث جديدة </div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('tags.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة  كلمة بحث جديدة</legend>


                        <label class="label">كلمة البحث :</label>
                        <input type="text" name="name" value="{{old('name')}}">
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active')==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('tags') !!}
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
