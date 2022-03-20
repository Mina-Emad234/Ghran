@extends('admin.index')
@section('content')
    <div id="middleContent">
        <a href="{{route('site_section.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>أقسام الواجهة الأمامية </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">تحديث قسم الواجهة الأمامية</div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('site_section.update',$section->id)}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">

                    <legend class="boxStyle">تحديث القسم</legend>
                    <input type="hidden" name="id" value="{{$section->id}}">
                    <label for="name" class="label">اسم القسم</label>
                    <input id="name" class="textBox med rnd5" name="name" value="{{$section->name}}"  />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />
                    <label class="label">النوع :</label>
                    <select size="1" name="section_type" class="select med rnd5">
                        <option value="images" @if(old('section_type',$section->section_type)=='images') selected @endif>images</option>
                        <option value="pages" @if(old('section_type',$section->section_type)=='pages') selected @endif>pages</option>
                        <option value="front links" @if(old('section_type',$section->section_type)=='front links') selected @endif>front links</option>
                    </select>
                    @error('section_type')
                    <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />
                    {!! RecaptchaV3::field('site_section') !!}
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
