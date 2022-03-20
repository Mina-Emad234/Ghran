@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المشترك</div>
            <div class="content">
                <a href="{{route('c_applicant.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المتقدمين للكورس</span>
                </a>
                <br /><br /><br />



                <strong>إسم المشترك : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->name}}<br>

                <strong>العمر :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->age }}<br>
                <strong>الحالة الإجتماعية :</strong><br>
                {{$applicant->marital_status }}<br>


                <strong> رقم الجوال :</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->mobile }}<br>

                <strong>البريد الإلكتروني : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->email }}<br>

                <strong>المدينة  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->city }}<br>

                <strong>الوظيفة  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->job }}<br>

                <strong> الكورس  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->course->name }}<br>
                <strong> تاريخ التسجيل  : </strong><br>
                {{ date("g:i a F j, Y ", strtotime($applicant->created_at))}}<br>
                 <strong> كود الدفع  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->payment_method }}<br>


            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
