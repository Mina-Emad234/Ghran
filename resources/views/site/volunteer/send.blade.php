@extends('site.index')
@section('title','الانتساب للفريق التطوعي')
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>



    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">أعضاء الفريق التطوعي</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">أعضاء الفريق التطوعي</li>
            </ul>
        </div>
    </div>





    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">

                    @if(session()->has('team_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('volunteer_success')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['volunteer_sent']))
                        <div class="alert alert-info">
                            <strong>تم تسجيل طلب الإنضمام من قبل غير مسموح بالتسجيل مرة أخرى  </strong>
                        </div>
                    @endif
                    @if(session()->has('volunteer_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('volunteer_error')}}</strong>
                        </div>
                    @endif

                <form method="post" action="{{route('volunteer.send')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>الاســـم</label>
                        <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="ادخل الاســـم">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label>الجنسية</label>
                        <x-country-select></x-country-select>
                        @error('nationality')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>الجنس</label>
                        <select name="gender" class="form-control">
                            <option value="" selected disabled>-----</option>
                            <option value="male" @if(old('gender')=='male') selected @endif>ذكر</option>
                            <option value="female" @if(old('gender')=='female') selected @endif>انثى</option>
                        </select>
                        @error('gender')
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
                        <label>المؤهل العلمي</label>
                        <input name="qualification" value="{{old('qualification')}}" type="text" class="form-control" placeholder="ادخل المؤهل العلمي">
                        @error('qualification')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>التخصص</label>
                        <input name="major" value="{{old('major')}}" type="text" class="form-control" placeholder="ادخل التخصص">
                        @error('major')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>جهة العمل</label>
                        <input name="job" value="{{old('job')}}" type="text" class="form-control" placeholder="ادخل جهة العمل">
                        @error('job')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>ماهي المهارات التي ترغب التطوع بها في مجال مؤهلك	</label>
                        <textarea name="skills"  class="form-control" rows="5">{{old('skills')}}</textarea>
                        @error('skills')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>هل شاركت في أعمال تطوعية سابقة؟</label>
                        <textarea name="voluntary" class="form-control" rows="5" placeholder="في حال الاجابة بنعم أرجو ذكرها :">{{old('voluntary')}}</textarea>
                        @error('voluntary')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>



                    <label>فترة العمل المناسبة</label>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="1" value="الصباحية" @if(collect(old('favor_time'))->contains('الصباحية'))checked @endif> الصباحية
                        </label>
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="2" value="المسائية" @if(collect(old('favor_time'))->contains('المسائية'))checked @endif>المسائية
                        </label>
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="3" value="بعد الظهر" @if(collect(old('favor_time'))->contains('بعد الظهر'))checked @endif> بعد الظهر
                        </label>
                        @error('favor_time')
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
                        <label>اسم ولي الأمر</label>
                        <input name="parent_name" value="{{old('parent_name')}}" type="text" class="form-control" placeholder="ادخل اسم ولي الأمر">
                        @error('parent_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>بريد إلكتروني ولي الأمر	</label>
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
                        <label>مهنة ولي الأمر	</label>
                        <input name="parent_job" value="{{old('parent_job')}}" type="text" class="form-control" placeholder="ادخل مهنة ولي الأمر	">
                        @error('parent_job')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <label>الأيام المناسبة</label>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox1" value="1" @if(collect(old('fav_days'))->contains(1)) checked @endif>السبت
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox2" value="2" @if(collect(old('fav_days'))->contains(2)) checked @endif>الأحد
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox3" value="3" @if(collect(old('fav_days'))->contains(3)) checked @endif>الاثنين
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox4" value="4" @if(collect(old('fav_days'))->contains(4)) checked @endif>الثلاثاء
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox5" value="5" @if(collect(old('fav_days'))->contains(5)) checked @endif>الاربعاء
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox6" value="6" @if(collect(old('fav_days'))->contains(6)) checked @endif>الخميس
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox7" value="7" @if(collect(old('fav_days'))->contains(7)) checked @endif>الجمعة
                        </label>
                        @error('fav_days')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! RecaptchaV3::field('volunteer') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror
                    </div>
                    <input @if(!isset($_COOKIE['volunteer_sent'])) type="submit" @endif class="btn btn-custom pull-left" value="إدخال">
                    <br><br>
                    </form>


                    <div class="clearfix"></div>

                </div>
            </div>

            @include('site.news.news')



        </div>

    </section>

@endsection
