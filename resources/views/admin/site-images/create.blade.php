@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('site.images.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة صور الموقع</span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة أو تعديل صورة للموقع </div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('site.images.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة أو تعديل صورة للموقع</legend>


                        <label class="label">الصفحة :</label>
                        <select size="1" name="site_section_id" class="select med rnd5">
                            @foreach($sections as $section)
                                <option value="{{$section->id}}" @if(old('site_section_id')==$section->id) selected @endif>{{$section->name}}</option>
                            @endforeach
                        </select>
                        @error('site_section_id')
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
                        {!! RecaptchaV3::field('site_image') !!}
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
