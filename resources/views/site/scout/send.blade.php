@extends('site.index')
@section('title','التسجيل في الكشافة')
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>



    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">التسجيل في الكشافة</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">التسجيل في الكشافة</li>
            </ul>
        </div>
    </div>





    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">

                    @if(session()->has('scout_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('scout_success')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['scout_sent']))
                        <div class="alert alert-info">
                            <strong>تم تسجيل طلب الإنضمام من قبل غير مسموح بالتسجيل مرة أخرى  </strong>
                        </div>
                    @endif
                    @if(session()->has('scout_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('scout_error')}}</strong>
                        </div>
                    @endif

                <form method="post" action="{{route('scout.send')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>الاســـم</label>
                        <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="ادخل الاســـم">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>العمر</label>
                        <input name="age" value="{{old('age')}}" type="text" class="form-control" placeholder="ادخل العمر">
                        @error('age')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>المدرسة</label>
                        <input name="school" value="{{old('school')}}" type="text" class="form-control" placeholder="ادخل المدرسة">
                        @error('school')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>المرحلة الدراسية</label>
                        <input name="grade" value="{{old('grade')}}" type="text" class="form-control" placeholder="ادخل المرحلة الدراسية">
                        @error('grade')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>العنوان</label>
                        <input name="address" value="{{old('address')}}" type="text" class="form-control" placeholder="ادخل العنوان">
                        @error('address')
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
                        <label>الهوايات</label>
                        <textarea name="interests"  class="form-control" rows="5">{{old('interests')}}</textarea>
                        @error('interests')
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


                    <div class="form-group">
                        <label>اسم ولي الأمر</label>
                        <input name="parent_name" value="{{old('parent_name')}}" type="text" class="form-control" placeholder="ادخل اسم ولي الأمر">
                        @error('parent_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>مهنة ولي الأمر</label>
                        <input name="parent_job" value="{{old('parent_job')}}" type="text" class="form-control" placeholder="ادخل مهنة ولي الأمر	">
                        @error('parent_job')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>بريد إلكتروني ولي الأمر</label>
                        <input name="parent_email" value="{{old('parent_email')}}" type="text" class="form-control" placeholder="ادخل بريد إلكتروني ولي الأمر	">
                        @error('parent_email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>جوال ولي الامر</label>
                        <input name="parent_mobile" value="{{old('parent_mobile')}}" type="text" class="form-control" placeholder="ادخل جوال ولي الامر">
                        @error('parent_mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>هاتف ولي الأمر</label>
                        <input name="parent_tel" value="{{old('parent_tel')}}" type="text" class="form-control" placeholder="ادخل جوال ولي الامر">
                        @error('parent_tel')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputFile">صورة بطاقة الأحوال</label>
                        <p class="help-block">هنا يوضع مكان للملاحظة من أجل الملفات المرفقة</p>
                        <div class="form-inline">
                            <div class="fileUpload btn btn-success">
                                <span>تحميل الملف</span>
                                <input name="image" id="uploadBtn" type="file" value="{{old('image')}}" class="upload">
                            </div>
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        {!! RecaptchaV3::field('scout') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror
                    </div>
                    <input @if(!isset($_COOKIE['scout_sent'])) type="submit" @endif class="btn btn-custom pull-left" value="إدخال">
                    <br><br>
                    </form>


                    <div class="clearfix"></div>

                </div>
            </div>

            @include('site.news.news')



        </div>

    </section>


@endsection
