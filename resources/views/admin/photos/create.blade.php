
@extends('admin.index')
@section('content')


    <div id="middleContent">
        <a href="{{route('photos.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
                <span>الصور </span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">إضافة صور جديدة </div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('photos.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة صور جديدة</legend>


                    <label for="image" class="label">الصور</label>
                    <div class="fileUpload">
                        <input id="file" type="file" name="photos[]" multiple/>
                        <span class="button rnd5 drkTextShadow">جلب الصور</span>
                        @error('photos')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                    </div>
                    <br />
                    <label class="label">قسم الصور :</label>
                    <select size="1" name="album_id" class="select rnd5">
                        @foreach ($albums as $album)
                            <option value="{{$album->id}}" @if($album->id==old('album_id')) selected @endif>{{$album->name}}</option>
                        @endforeach
                    </select>
                    @error('album_id')
                    <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />
                    {!! RecaptchaV3::field('photo') !!}
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
