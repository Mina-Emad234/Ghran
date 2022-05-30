@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المحتوى</div>
            <div class="content">
                <a href="{{route('site.content.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المحتوى</span>
                </a>
                <br /><br /><br />
                <strong>العنوان : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$content->title}}<br>

                <strong>قسم الواجهة الأمامية : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$content->site_section->name}}<br>



                <strong>نص المحتوى : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {!!$content->body!!}<br>


            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
