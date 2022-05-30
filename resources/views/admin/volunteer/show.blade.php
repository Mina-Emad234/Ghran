@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المشترك</div>
            <div class="content">
                <a href="{{route('volunteer.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الفريق التطوعي</span>
                </a>
                <br /><br /><br />
                <strong> الاســـم :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->name}}<br>


                <strong> الجنسية  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->nationality}}<br>


                <strong> الجنس :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->gender}}<br>


                <strong> المدينة  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->city}}<br>

                <strong> العمر  :</strong><br>
                {{$volunteer->age}}<br>


                <strong> رقم الجوال :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->mobile}}<br>


                <strong> العنوان  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->address}}<br>


                <strong> الحالة الاجتماعية  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->marital_status}}<br>


                <strong> البريد الالكتروني :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->email}}<br>


                <strong> المؤهل العلمي  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->qualification}}<br>


                <strong> التخصص  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->major}}<br>


                <strong> جهة العمل  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->job}}<br>


                <strong> المهارات الراغب بالتطوع بها</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->skills}}<br>

                <strong> المشاركة في اعمال تطوعية سابقة</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->voluntary}}<br>

                <strong>فترة العمل المناسبة </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->favor_time}}<br>

                <strong>صورة بطاقة الأحوال </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p style="margin-right: 50px">
                    @if ($volunteer->image != "" && file_exists("uploads/volunteers/" . $volunteer->image))
                        <img src="{{asset('uploads/volunteers/'. $volunteer->image)}}" width="160" height="130" class="imgPreview rnd10" />
                    @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                    @endif
                </p>

                <strong>اسم ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->parent_name}}<br>

                <strong>مهنة ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->parent_job}}<br>

                <strong>بريد إلكتروني ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->parent_email}}<br>


                <strong>هاتف ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->parent_tel}}<br>

                <strong>جوال ولي الامر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->parent_mobile}}<br>


                <strong>الأيام المناسبة </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$volunteer->fav_days}}<br>

            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
