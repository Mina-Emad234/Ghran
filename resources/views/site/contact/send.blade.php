@extends('site.index')
@section('title','الاتصال بنا')
@section('content')
    <style>
        .reload {
            font-family: Lucida Sans Unicode
        }
    </style>
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">الاتصال بنا</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">الاتصال بنا</li>
            </ul>
        </div>
    </div>








    <section class="inner">

        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if(session()->has('contact_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('contact_success')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['contact_sent']))
                        <div class="alert alert-info">
                            <strong>تم الإرسال من قبل إذا كنت التواصل معنا مرة أخرى حاول مجددًا خلال 48 ساعة </strong>
                        </div>
                    @endif
                    @if(session()->has('contact_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('contact_error')}}</strong>
                        </div>
                    @endif
                    <form method="post" action="{{route('contact.send')}}" enctype="multipart/form-data">
                        @CSRF
                    <div class="form-group">
                        <label>الاسم</label>
                        <input name="sender"  value="{{old('sender')}}" type="text" class="form-control" placeholder="ادخل الاسم">
                        @error('sender')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input name="email"  value="{{old('email')}}" type="text" class="form-control" placeholder="ادخل البريد الالكتروني">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>عنوان الرسالة</label>
                        <select name="title"   class="form-control">
                            <option selected disabled>-----</option>
                            <option value="شكر" @if(old('title')=='شكر') selected @endif>شكر</option>
                            <option value="اسفسار" @if(old('title')=='اسفسار') selected @endif>اسفسار</option>
                            <option value="اقتراح" @if(old('title')=='اقتراح') selected @endif>اقتراح</option>
                            <option value="دعم" @if(old('title')=='دعم') selected @endif>دعم</option>
                            <option value="غير ذلك" @if(old('title')=='غير ذلك') selected @endif>غير ذلك</option>
                        </select>
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>محتوى الرسالة</label>
                        <textarea name="content" class="form-control" rows="5">{{old('content')}}</textarea>
                        @error('content')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputFile">ملفات مرفقة</label>
                        <div class="col-md-12 mb-2">
                            <img id="preview-image" width="200px" style="margin: 10px">
                        </div>
                        <p class="help-block">الملفات المسموح بها هي الصور والفيديوهات والنصوص</p>
                        <div class="form-inline">
                            <div class="fileUpload btn btn-success">
                                <span>تحميل الملف</span>
                                <input  id="inputImage" name="file" type="file" class="upload">
                            </div>
                        </div>
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! RecaptchaV3::field('contact') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror

                    </div>
                    <input @if(!isset($_COOKIE['contact_sent'])) type="submit" @endif class="btn btn-custom pull-left" value="إرسال الرسالة"/>
                    <br/><br/>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="arrow_box"><h3>معلومات الاتصال</h3></div>
                    @if(!empty(config()->get('app.telefax')))
                    <p class="font"><strong>تلفــــــاكس</strong>&nbsp; {{config()->get('app.telefax')}}</p>
                    @endif
                    @if(!empty(config()->get('app.mobile')))
                    <p class="font"><strong>الجــــــــــــــوال</strong>&nbsp; {{config()->get('app.mobile')}}</p>
                    @endif
                    @if(!empty(config()->get('app.mobile')))
                    <p class="font"><strong>البريد الالكتروني</strong>&nbsp; {{config()->get('app.email')}}</p>
                    @endif
                    <div class="arrow_box"><h3>شبكات التواصل الاجتماعي</h3></div>

                    <ul class="social-contact text-center">
                        @if(!empty(config()->get('app.facebook')))
                            <li><a href="{{config()->get('app.facebook')}}" class="fa" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if(!empty(config()->get('app.twitter')))
                            <li><a href="{{config()->get('app.twitter')}}" class="tw" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if(!empty(config()->get('app.youtube')))
                            <li><a href="{{config()->get('app.youtube')}}" class="you" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        @endif
                        @if(!empty(config()->get('app.instagram')))
                            <li><a href="{{config()->get('app.instagram')}}" class="ins" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        @endif
                    </ul>


                </div>
            </div><!-- row -->
        </div><!-- container -->

    </section>


@endsection
