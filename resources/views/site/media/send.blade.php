@extends('site.index')
@section('title','الانتساب للمركز الإعلامي')
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>



    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">الانتساب للمركز الإعلامي</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">الانتساب للمركز الإعلامي</li>
            </ul>
        </div>
    </div>




    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">

                    @if(session()->has('media_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('media_success')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['media_sent']))
                        <div class="alert alert-info">
                            <strong>تم تسجيل طلب الإنضمام من قبل غير مسموح بالتسجيل مرة أخرى  </strong>
                        </div>
                    @endif
                    @if(session()->has('media_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('media_error')}}</strong>
                        </div>
                    @endif

                <form method="post" action="{{route('media.send')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>الاســـم</label>
                        <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="ادخل الاســـم">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>رقم الهوية</label>
                        <input name="identity" value="{{old('identity')}}" type="text" class="form-control" placeholder="رقم الهوية">
                        @error('identity')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input name="mobile" value="{{old('mobile')}}" type="text" class="form-control" placeholder="ادخل رقم الجوال">
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input name="email" value="{{old('email')}}" type="text" class="form-control" placeholder="ادخل البريد الالكتروني">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <label>المجال الاعلامي</label>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="radio" value="التصوير الفوتوغرافي" id="inlineCheckbox1" name="course" @if(old('courses')=='التصوير الفوتوغرافي') checked @endif>التصوير الفوتوغرافي
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="المونتـــــــــاج" id="inlineCheckbox2" name="course" @if(old('courses')=='المونتـــــــــاج') checked @endif> المونتـــــــــاج
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="إدارة المواقع الالكترونية" id="inlineCheckbox3" name="course" @if(old('courses')=='إدارة المواقع الالكترونية') checked @endif> إدارة المواقع الالكترونية
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="radio" value="تصويــــر الفيديو" id="inlineCheckbox4" name="course" @if(old('courses')=='تصويــــر الفيديو') checked @endif>تصويــــر الفيديو
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="التصميـــــــــم" id="inlineCheckbox5" name="course" @if(old('courses')=='التصميـــــــــم') checked @endif>التصميـــــــــم
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="التمثيـــــــــل" id="inlineCheckbox6" name="course" @if(old('courses')=='التمثيـــــــــل') checked @endif>التمثيـــــــــل
                        </label>
                        <br>
                    </div>
                    <div class="form-group">
                        {!! RecaptchaV3::field('media') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror
                    </div>
                    <input @if(!isset($_COOKIE['media_sent'])) type="submit" @endif class="btn btn-custom pull-left" value="إدخال">
                    <br><br>
                    </form>


                    <div class="clearfix"></div>


                </div>
            </div>

            @include('site.news.news')


        </div>

    </section>

@endsection
