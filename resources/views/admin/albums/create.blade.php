@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">إضافة قسم جديد للصور</div>
            <br />
            <a href="{{route('albums.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>أقسام الصور</span>
            </a>
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('albums.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة قسم جديد للصور</legend>

                    <label for="name" class="label">اسم القسم</label>
                    <input id="name" class="textBox med rnd5" name="name"  />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />
                    <br />
                    <br />
                    <label for="image" class="label">الصورة</label>
                    <div class="fileUpload">
                        <input id="file" type="file" name="image"   />
                        <span class="button rnd5 drkTextShadow">جلب الملف</span>
                        @error('image')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                    </div>
                    <br />
                        {!! RecaptchaV3::field('album') !!}
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
