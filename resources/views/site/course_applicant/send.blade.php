@extends('site.index')
@section('title','التسجيل في دورة' . $course->name)
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>



    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right"> التسجيل في دورة{{$course->name}}</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">التسجيل</li>
            </ul>
        </div>
    </div>





    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">

                    @if(session()->has('applicant_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('applicant_success')}}</strong>
                        </div>
                    @endif

                    @if(session()->has('applicant_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('applicant_error')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['course_id']) && $_COOKIE['course_id'] == $course->id && isset($_COOKIE['register_mobile']))
                        <div class="alert alert-info">
                            <strong>تم التسجيل في هذه الدورة من قبل غير مسموح بالتسجيل مرة أخرى  </strong>
                        </div>
                    @else
                <p><b>يرجى التنبيه بأن عملية التسجيل وسداد الرسوم تتم من خلال الموقع لا غير</b></p>
                <form method="post" action="{{route('course_applicant.send',$course->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <div class="form-group">
                        <label>الاســـم</label>
                        <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="ادخل الاســـم">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">
                        <label>المدينة</label>
                        <input name="city" value="{{old('city')}}" type="text" class="form-control" placeholder="ادخل المدينة">
                        @error('city')
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
                        <label>الوظيفة</label>
                        <input name="job" value="{{old('job')}}" type="text" class="form-control" placeholder="ادخل الوظيفة">
                        @error('job')
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
                        <label>العنوان</label>
                        <input name="address" value="{{old('address')}}" type="text" class="form-control" placeholder="ادخل العنوان">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>الحالة الاجتماعية</label>

                            <select name="marital_status" class="form-control">
                                <option value="" selected disabled>-----</option>
                                <option value="خاطب/مخطوبة" @if(old('marital_status')== 'خاطب/مخطوبة') selected @endif>خاطب/مخطوبة</option>
                                <option value="متملك/متملكة" @if(old('marital_status')== 'متملك/متملكة') selected @endif>متملك/متملكة</option>
                                <option value="سنة أولى زواج" @if(old('marital_status')== 'سنة أولى زواج') selected @endif>سنة أولى زواج</option>
                            </select>
                        @error('marital_status')
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
                        {!! RecaptchaV3::field('applicant') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror
                    </div>
                        <p>إضغط هنا لإستكمال إجراءات سداد الرسوم وتسجيل البيانات</p>

                    <input type="submit"  class="btn btn-custom pull-left" value="إدخال">
                    <br><br>
                    </form>

                        @endif
                    <div class="clearfix"></div>

                </div>
            </div>

            @include('site.news.news')



        </div>

    </section>

@endsection
