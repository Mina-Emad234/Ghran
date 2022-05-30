<div id="rightColumn">
    <a href="javascript:void(0)" id ="logo"><img src="{{asset('admins/images/logo.png')}}" alt="" /></a>
    <!-- Login Info Start -->
    <div id="loginInfo" class="drkTextShadow rnd5">
        <h3 dir="ltr">{{auth('admin')->user()->name}}</h3><br>
        @can('contacts')
        <a href="{{route('contact.index')}}" title="لديك {{\App\Models\Contact::where('read',0)->count()}} رسائل جديدة"><img src="{{asset('admins/images/email.png')}}" alt=""/>
            <span class="count rnd3">{{\App\Models\Contact::where('read',0)->count()}}</span></a>
        @endcan
        @can('comments')
        <a href="{{route('comments.index')}}" title=" لديك {{\App\Models\Comment::where('active',0)->count()}} تعليقات جديدة"><img src="{{asset('admins/images/comment.png')}}" alt=""/>
            <span class="count rnd3">{{\App\Models\Comment::where('active',0)->count()}}</span></a>
        @endcan
        <a href="" class="operation" title="تسجيل الخروج"><img src="{{asset('admins/images/logout.png')}}" alt=""/></a>
        <form method="post" id="logout" action="{{route('admin.logout')}}" style="display: none">
            @csrf
        </form>
    </div><!-- Login Info End -->
    <!-- Menu Start -->
    <div class="block">
        <div class="content">
            <ul id="rightNav" class="menu drkTextShadow">
                <li>
                    <a href="{{route("admin.home")}}">
                        <img src="{{asset('admins/images/icons/dashboard.png')}}" alt="" />لوحة التحكم</a></li>
                @can('photos')
                <li><a href="{{route("photos.index")}}" >
                        <img src="{{asset('admins/images/icons/media.png')}}" alt="" />استديو الصور</a></li>
                @endcan
                @can('blogs')
                    @foreach($categories as $category)
                <li><a href="{{route('blogs.cats',$category->slug)}}" >
                        <img src="{{asset('uploads/categories/'.$category->image)}}" alt="" />{{$category->name}} </a></li>
                @endforeach
                @endcan
                @can('admins')
                <li><a href="{{route('admins.index')}}" >
                        <img src="{{asset('admins/images/icons/users.png')}}" alt="" />المستخدمين</a></li>
                @endcan
                @can('votes')
                <li><a href="{{route('questions.index')}}">
                        <img src="{{asset('admins/images/icons/vote.png')}}" alt="" />التصويت</a></li>
                @endcan

            </ul>
        </div>
        </div>
    </div><!-- Menu End -->


