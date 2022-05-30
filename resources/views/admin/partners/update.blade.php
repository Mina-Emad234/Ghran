@extends('admin.index')
@section('content')
    <div id="middleContent">
        <a href="{{route('partners.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>شركاؤنا </span>
        </a>
        <div class="block">
            <div class="name lightTextShadow">تحديث الكورس</div>
            <br />



            <div class="content">
                <form method="POST" action="{{route('partners.update',$partner->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث شريك</legend>
                        <input type="hidden" name="id" value="{{$partner->id}}">
                        <label class="label">الاسم :</label>
                        <input id="name" class="textBox med rnd5" name="name" value="{{old('name',$partner->name)}}" />
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
                        <label class="label">الصورة الحالية</label>
                        <p style="margin-right: 50px">
                            @if ($partner->image != "" && file_exists("uploads/partners/" . $partner->image))
                                <img src="{{'../../../uploads/partners/'. $partner->image}}" width="160" height="130" class="imgPreview rnd10" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                            @endif
                        </p>
                        <br />

                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active',$partner->active)==1) checked @endif/>
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
