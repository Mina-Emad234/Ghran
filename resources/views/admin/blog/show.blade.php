@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تفاصيل المنشور</div>
            <div class="content">
                <a href="{{route('blog.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>المنشورات</span>
                </a>
                <br /><br /><br />
                <strong>العنوان : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$blog->title}}<br>

                <strong>القسم : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$blog->category->name}}<br>

                <strong>تاريخ المنشور : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ date("g:i a F j, Y ", strtotime($blog->created_at))}}<br>

                <label class="label">الصورة</label>
                <p style="margin-right: 50px">
                    @if ($blog->image != "" && file_exists("uploads/blogs/" . $blog->image))
                        <img src="{{'../../../uploads/blogs/'. $blog->image}}" width="160" height="130" class="imgPreview rnd10" />
                    @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="160" height="130" class="imgPreview rnd10" />
                    @endif
                </p>

                <strong>نص المنشور : </strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{$blog->body}}<br>


            </div>
        </div><!-- Data Grid End -->
    </div>
@endsection
