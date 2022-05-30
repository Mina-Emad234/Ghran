@extends('admin.index')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/icon.css')}}">
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/default/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/easyui/themes/icon.css')}}">
    <script type="text/javascript" src="{{asset('admins/easyui/jquery.easyui.min.js')}}"></script>

    <div id="middleContent">
        <a href="{{route('blogs.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>المنشورات <img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new"/></span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">تحديث المنشور </div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('blogs.update',$blog->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">تحديث المنشور </legend>
                        <input type="hidden" name="id" value="{{$blog->id}}" />

                        <label class="label">العنوان :</label>
                        <input id="name" class="textBox med rnd5" name="title" value="{{$blog->title}}" />
                        @error('title')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">القسم :</label>
                        <select size="1" name="category_id" class="select rnd5">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if($category->id==$blog->category_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">كلمات البحث :</label>
                        <select class="select" name="tags[]" multiple>
                            <option class="disabled" style="font-size: 12px;font-weight: bold">إختار العديد باستخدام زر الفارة الأيمن وزر ال ctrl</option>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" @if(collect(old('tags'))->contains($tag->id) || collect($blog->tags->modelKeys())->contains($tag->id)) selected @endif>{{$tag->name}}</option>
                            @endforeach
                        </select>
                        <br />
                        <label class="label">الموضوع :</label>
                        <textarea  name="body" id="textEditor" rows="6" cols="0" class="textArea lrg rnd5">{{$blog->body}}</textarea><br /><br />
                        @error('body')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الصورة الحالية</label>
                        <p style="margin-right: 50px">
                            @if ($blog->image != "" && file_exists("uploads/blogs/" . $blog->image))
                            <img src="{{'../../../uploads/blogs/'. $blog->image}}" width="160" height="130" class="imgPreview rnd10" />
                            @else
                            <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                            @endif
                        </p>
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
                        <input type="checkbox" name="active" id="chk1" value="1" @if($blog->active==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('blogs') !!}
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
@push('sripts')
    <script type="text/javascript" src="{{asset('admins/easyui/jquery.easyui.min.js')}}"></script>
@endpush
