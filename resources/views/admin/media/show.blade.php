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
                {{$media->name}}<br>

                <strong>رقم الهوية   : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$media->identity}}<br>

                <strong>رقم الجوال   : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$media->mobile}}<br>

                <strong>البريد الإلكتروني   : </strong><br>

                {{$media->email}}<br>


                <strong>الدورة المطلوبة  : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$media->course}}<br>
              </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
