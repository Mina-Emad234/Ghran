@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تحديث قسم الصور </div>
            <br />
            <a href="{{route('albums.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>أقسام الصور</span>
            </a>
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('albums.update',$album->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                <fieldset class="form boxStyle">

                    <legend class="boxStyle">تحديث قسم الصور</legend>
                    <input type="hidden" name="id" value="{{$album->id}}">
                    <label for="name" class="label">اسم القسم</label>
                    <input id="name" class="textBox med rnd5" name="name" value="{{$album->name}}"  />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <label class="label">الصورة الحالية</label>
                    <p style="margin-right: 50px">
                        @if ($album->image != "" && file_exists("uploads/albums/" . $album->image))
                        <img src="{{'../../../uploads/albums/'. $album->image}}" width="160" height="130" class="imgPreview rnd10" />
                         @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                        @endif
                    </p>

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
