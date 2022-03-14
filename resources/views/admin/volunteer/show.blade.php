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
                {{$team->name}}<br>


                <strong> الجنسية  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->nationality}}<br>


                <strong> الجنس :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->gender}}<br>


                <strong> المدينة  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->city}}<br>

                <strong> العمر  :</strong><br>
                {{$team->age}}<br>


                <strong> رقم الجوال :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->mobile}}<br>


                <strong> العنوان  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->address}}<br>


                <strong> الحالة الاجتماعية  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->marital_status}}<br>


                <strong> البريد الالكتروني :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->email}}<br>


                <strong> المؤهل العلمي  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->qualification}}<br>


                <strong> التخصص  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->major}}<br>


                <strong> جهة العمل  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->job}}<br>


                <strong> المهارات الراغب بالتطوع بها</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->skills}}<br>

                <strong> المشاركة في اعمال تطوعية سابقة</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->voluntary}}<br>

                <strong>فترة العمل المناسبة </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->favor_time}}<br>

                <strong>صورة بطاقة الأحوال </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p style="margin-right: 50px">
                    @if ($team->image != "" && file_exists("uploads/volunteer/" . $team->image))
                        <img src="{{'../../../uploads/volunteer/'. $team->image}}" width="160" height="130" class="imgPreview rnd10" />
                    @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                    @endif
                </p>

                <strong>اسم ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->parent_name}}<br>

                <strong>مهنة ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->parent_job}}<br>

                <strong>بريد إلكتروني ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->parent_email}}<br>


                <strong>هاتف ولي الأمر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->parent_tel}}<br>

                <strong>جوال ولي الامر </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->parent_mobile}}<br>


                <strong>الأيام المناسبة </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$team->fav_days}}<br>

            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
