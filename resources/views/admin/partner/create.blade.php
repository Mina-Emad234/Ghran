@extends('admin.index')
@section('content')
    <div id="middleContent">
        <a href="{{route('partner.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
                <span>شركاؤنا </span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">إضافة شريك جديد </div>
            <br />



            <div class="content">
                <form method="POST" action="{{route('partner.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة شريك جديد</legend>

                    <label class="label">الاسم :</label>
                    <input id="name" class="textBox med rnd5" name="name" value="{{old('name')}}" />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
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

                    <label for="chk1" class="label">تفعيل</label>
                    <input type="checkbox" name="active" id="chk1" value="1" @if(old('active')==1) checked @endif/>
                    <br />
                    {!! RecaptchaV3::field('partner') !!}
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
