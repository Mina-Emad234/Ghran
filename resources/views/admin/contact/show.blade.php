@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل الرسالة</div>
            <div class="content">
                <a href="{{route('contact.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>الرسائل</span>
                </a>
                <br /><br /><br />
                <strong>إسم الراسل : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$contact->sender}}<br>



                <strong>البريد الإلكتروني : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$contact->email}}<br>

                <strong>تاريخ الرسالة : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ date("g:i a F j, Y ", strtotime($contact->created_at))}}<br>

                <strong>عنوان الرسالة : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$contact->title}}<br>

                <strong>نص الرسالة : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$contact->content}}<br>
                @if(!empty($contact->file))
                <strong>الملف : </strong><br>
                <a href="{{route('contact.open',['email'=>$contact->email,'file'=>$contact->file])}}">{{$contact->file}}</a><br>
                    @endif
            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
