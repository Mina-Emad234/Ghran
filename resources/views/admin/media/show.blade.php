@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المشترك</div>
            <div class="content">
                <a href="{{route('media.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المركز الإعلامي</span>
                </a>
                <br /><br /><br />
                <strong>الإسم الثلاثي  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->name}}<br>

                <strong>رقم الهوية   : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->identity}}<br>

                <strong>رقم الجوال   : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->mobile}}<br>

                <strong>البريد الإلكتروني   : </strong><br>

                {{$applicant->email}}<br>


                <strong>الدورة المطلوبة  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$applicant->course}}<br>
              </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
