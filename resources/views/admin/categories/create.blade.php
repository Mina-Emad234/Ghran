@extends('admin.index')
@section('content')
    <div id="middleContent">
        <a href="{{route('categories.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>الأقسام </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة قسم جديد </div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة  قسم جديد</legend>

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
                        <input id="inputImage" type="file" name="image"   />
                        <span class="button rnd5 drkTextShadow">جلب الملف</span>
                        @error('image')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                    </div>
                    <br />
                    <div class="col-md-12 mb-2">
                        <img id="preview-image" width="200px" style="margin: 10px">
                    </div>
                    <br />
                    {!! RecaptchaV3::field('categories') !!}
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
