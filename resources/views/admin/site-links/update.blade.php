@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('site.links.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
            <span>الروابط</span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">تحديث رابط</div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('site.links.update',$link->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث رابط</legend>
                        <input type="hidden" name="id" value="{{$link->id}}">
                        <label class="label">الاسم :</label>
                        <input id="name" class="textBox med rnd5" name="name" value="{{old('name',$link->name)}}" />
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">قسم الواجهة الأمامية :</label>
                        <select size="1" name="site_section_id" class="select med rnd5">
                            @foreach ($sections as $section)
                                <option value="{{$section->id}}" @if($link->site_section_id==old('site_section_id',$section->id)) selected @endif>{{$section->name}}</option>
                            @endforeach
                        </select>
                        @error('site_section_id')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label class="label">اسم الرابط الأساسي :</label>
                        <select size="1" name="parent_id" class="select med rnd5">
                            @forelse ($parents as $parent)
                                <option selected disabled>لا يوجد</option>
                                <option value="{{$parent->id}}" @if($link->parent_id==old('parent_id',$parent->id)) selected @endif>{{$parent->name}}</option>
                            @empty
                                <option selected disabled>لا يوجد</option>
                            @endforelse
                        </select>
                        @error('parent_id')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الرابط :</label>
                        <input id="name" class="textBox med rnd5" name="link" value="{{old('link',$link->link)}}" dir="ltr" />
                        @error('link')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active',$link->active)==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('link') !!}
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

