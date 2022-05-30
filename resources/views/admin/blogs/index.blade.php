@extends('admin.index')
@section('content')
<div id="middleContent">

    <!-- Data Grid Start -->
    <div class="block">
        <div class="title lightTextShadow">{{$category->name??'المنشورات'}}</div>
        <div class="content">
            <a href="{{route('blogs.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>منشور جديد<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
            </a>
            <!-- Notification boxes -->
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif
            @if(session()->has('success_msg'))
                <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
                <br />
            @endif
            @if(count($blogs)==0)
                <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
            @else
            <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>مسلسل</th>
                    <th>العنوان</th>
                    @if(!isset($category))
                    <th>القسم</th>
                    @endif
                    <th>التعليقات</th>
                    <th>كلمات البحث</th>
                    <th>الصورة</th>
                    <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $row=0;
                    $counter = $row + 1;
                @endphp
                @foreach($blogs as $blog)

                <tr @if($counter % 2 == 1)
                         class='odd'
                    @endif >
                    <td class="align-center">{{$counter}}</td>
                    <td><a href="{{route('blogs.show',$blog->id)}}">{{strlen($blog->title)>50?substr($blog->title,0,strpos($blog->title,' ',50)).'...': $blog->title}}</a></td>
                    @if(!isset($category))
                    <td>{{$blog->category->name}}</td>
                    @endif
                    <td><a href="{{route('comments.index',$blog->slug)}}">{{$blog->comments_count}} تعليقات</a></td>
                    <td><a href="{{route('tags.blogs',$blog->slug)}}">{{$blog->tags_count}} كلمات بحث</a></td>
                    <td>
                        @if($blog->image != "" && file_exists("uploads/blogs/" . $blog->image))
                        <img src="{{'../../../uploads/blogs/'.$blog->image}}" width="80" height="50" />
                        @else
                        <img src="{{asset('admins/images/no-img.png')}}" width="80" height="50" />
                        @endif
                    </td>

                    <td title="">
                        @if ($blog->active == 0)

                        <a  title="تفعيل " class="tool boxStyle"
                           href="{{route('blogs.activate',$blog->id)}}"><img
                                alt="تفعيل"
                                src="{{asset('admins/images/icons/active.png')}}"></a>
                        @else
                        <a  title="الغاء تفعيل " class="tool boxStyle"
                           href="{{route('blogs.deactivate',$blog->id)}}"><img
                                alt="الغاء تفعيل"
                                src="{{asset('admins/images/icons/deactive.png')}}"></a>
                        @endif

                            <a  style="float: right" title="تعديل البيانات" class="tool boxStyle" href="{{route('blogs.edit',$blog->id)}}"  ><img src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل" /></a>
                            <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                            <form method="post" action="{{route('blogs.destroy',$blog->id)}}" style="display: none">
                                @csrf
                                @method('delete')
                            </form>
                    </td>
                </tr>
                @php
                $counter++
                @endphp
                @endforeach


                </tbody>
            </table>
                <div class="pager">
                    {!! $blogs->links("pagination::bootstrap-4") !!}
                </div>
        </div>
    </div><!-- Data Grid End -->
</div><!-- Data Grid End -->

@endif
@endsection

