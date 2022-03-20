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
        <a href="{{route('comment.index')}}" title=" لديك {{\App\Models\Comment::where('active',0)->count()}} تعليقات جديدة"><img src="{{asset('admins/images/comment.png')}}" alt=""/>
            <span class="count rnd3">{{\App\Models\Comment::where('active',0)->count()}}</span></a>
        @endcan
        <a href="{{route('admin.logout')}}" title="تسجيل الخروج"><img src="{{asset('admins/images/logout.png')}}" alt=""/></a>
    </div><!-- Login Info End -->
    <!-- Menu Start -->
    <div class="block">
        <div class="content">
            <ul id="rightNav" class="menu drkTextShadow">
                <li>
                    <a href="{{route("admin.home")}}">
                        <img src="{{asset('admins/images/icons/dashboard.png')}}" alt="" />لوحة التحكم</a></li>
                @can('photos')
                <li><a href="{{route("photo.index")}}" >
                        <img src="{{asset('admins/images/icons/media.png')}}" alt="" />استديو الصور</a></li>
                @endcan
                @can('blogs')
                    @if(\App\Models\BlogCategory::find(1))
                <li><a href="{{route('cat.blogs',1)}}" >
                        <img src="{{asset('admins/images/icons/articles.png')}}" alt="" />المقالات </a></li>
                @endif
                @if(\App\Models\BlogCategory::find(2))
                <li><a href="{{route('cat.blogs',2)}}" >
                     <img src="{{asset('admins/images/icons/news.png')}}" alt="" />الاخبار </a></li>
                @endif
                @if(\App\Models\BlogCategory::find(3))
                <li><a href="{{route('cat.blogs',3)}}">
                        <img src="{{asset('admins/images/icons/Muslim_Female.png')}}" alt="" />الاقسام النسائية</a></li>
                @endif
                @if(\App\Models\BlogCategory::find(4))
                <li><a href="{{route('cat.blogs',4)}}">
                        <img src="{{asset('admins/images/icons/chat.png')}}" alt="" />قالوا عنا</a></li>
                @endif
                @endcan
                @can('users')
                <li><a href="{{route('admin.index')}}" >
                        <img src="{{asset('admins/images/icons/users.png')}}" alt="" />المستخدمين</a></li>
                @endcan
                @can('votes')
                <li><a href="{{route('v_question.index')}}">
                        <img src="{{asset('admins/images/icons/vote.png')}}" alt="" />التصويت</a></li>
                @endcan

            </ul>
        </div>
        </div>
    </div><!-- Menu End -->

