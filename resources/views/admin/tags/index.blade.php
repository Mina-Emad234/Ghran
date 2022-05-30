@extends('admin.index')
@section('content')
    <div id="middleContent">

        <!-- Data Grid Start -->
        @if(session()->has('error_msg'))
            <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
            <br />
        @endif
        @if(session()->has('success_msg'))
            <p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
            <br />
        @endif
        <div class="block">
            <div class="title lightTextShadow">{{$blog->title??'قائمة كلمات البحث'}} </div>

            <div class="content">
                <a href="{{route('tags.create')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                    <span>اضف كلمة بحث<img src="{{asset('admins/images/plus-small.gif')}}" width="12" height="9" alt="New new" /></span>
                </a>


                <!-- Notification boxes -->

                @if(count($tags) == 0)
                    <br/>
                    <p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه!</b>لا توجد بيانات مضافة<p>
                @else
                    <table class="dataGrid tableSorter boxStyle" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th>كلمة البحت</th>
                            <th >التاريخ</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $row=0;
                            $counter = $row + 1;
                        @endphp
                        @foreach($tags as $tag)
                            <tr
                                @if($counter % 2 == 1)
                                class='odd'
                                @endif
                            >
                                <td class="align-center">{{$counter}}</td>
                                <td>{{$tag->name}}</td>
                                <td><span dir="ltr">{{$tag->created_at->diffForHumans()}}</span></td>
                                <td>
                                    @if($tag->active == 1)
                                        <a  title="الغاء تفعيل " class="tool boxStyle" href="{{route('tags.deactivate',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/deactive.png')}}"></a>
                                    @else
                                        <a  title="تفعيل " class="tool boxStyle" href="{{route('tags.activate',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/active.png')}}"></a>
                                    @endif

                                    <a title="تعديل البيانات"  class="tool boxStyle" href="{{route('tags.edit',$tag->id)}}"><img alt="" src="{{asset('admins/images/icons/Pencil.png')}}" alt="تعديل"> </a>
                                        <a title="حذف البيانات" class="tool boxStyle operation" onclick="confirm('هل تريد حذف هذا العنصر؟');"><img src="{{asset('admins/images/icons/Trash.png')}}" alt="حذف" /></a>
                                        <form method="post"  action="{{route('tags.destroy',$tag->id)}}" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pager">
                        {!! $tags->links("pagination::bootstrap-4") !!}
                    </div>
                @endif
            </div>
        </div><!-- Data Grid End -->
    </div>



@endsection
