@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المشترك</div>
            <div class="content">
                <a href="{{route('scouts.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الكشافة</span>
                </a>
                <br /><br /><br />

                <label class="label">صورة المشترك</label>
                <p style="margin-right: 50px">
                    @if ($scout->image != "" && file_exists("uploads/scouts/" . $scout->image))
                        <img src="{{'../../../uploads/scouts/'. $scout->image}}" width="160" height="130" class="imgPreview rnd10" />
                    @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                    @endif
                </p>

                <strong>إسم المشترك : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->name}}<br>

                <strong>العمر :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->age }}<br>

                <strong>المدرسة  :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->school }}<br>
                <strong>المرحلة الدراسية   :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->grade }}<br>

                <strong>الهوايات     :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->interests }}<br>

                <strong>عنوان السكن      :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->address }}<br>

                <strong> رقم الجوال :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->mobile }}<br>

                <strong>البريد الإلكتروني : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->email }}<br>

                <strong>اسم ولي الأمر  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->parent_name }}<br>

                <strong> مهنة ولي الأمر  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->parent_job }}<br>

                <strong> هاتف ولي الأمر  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->parent_tel }}<br>

                <strong> جوال ولي الامر   : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->parent_mobile }}<br>

                <strong> بريد إلكتروني ولي الأمر : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$scout->parent_email }}<br>

            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
