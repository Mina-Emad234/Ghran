@extends('admin.index')

@section('content')
    <div id="middleContent">
        <div style="clear:both;"></div>
        <!-- Dashboard Gallery Strat -->
        <div class="block">
            <div class="title lightTextShadow">لوحة التحكم</div>
            <div class="content">
                <ul class="gallery dashboard">
                    @can('blogs')
                    <li><a href="{{route('blogs.create')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/add_page.png')}}" alt="" /><br />مقال جديد</a></li>
                    @endcan
                    @can('admins')
                    <li><a href="{{route('admins.create')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/add_user.png')}}" alt="" /><br />مستخدم جديد</a></li>
                    @endcan
                    @can('roles')
                    <li><a href="{{route('roles.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/17.png')}}" alt="" /><br />الصلاحيات</a></li>
                    @endcan
                    @can('photos')
                    <li><a href="{{route('photos.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}" alt="" /><br />ألبوم الصور</a></li>
                    @endcan
                    @can('photo_category')
                    <li><a href="{{route('albums.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}" alt="" /><br />أقسام الصور</a></li>
                    @endcan
                    @can('contacts')
                    <li><a href="{{route('contact.index')}}" class="boxStyle" title="صندوق الوارد لديك {{\App\Models\Contact::where('read',0)->count()}} رسائل جديدة"><span class="count rnd3">{{\App\Models\Contact::where('read',0)->count()}}</span>
                            <img src="{{asset('admins/images/icons/12.png')}}" alt="" /><br />رسائل واردة</a></li>
                    @endcan
                    @can('mails')
                    <li><a href="{{route('mails.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/mailing_list.png')}}" alt="" /><br />القوائم البريدية </a></li>
                    @endcan
                    @can('socials')
                    <li><a href="{{route('scouts.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/volunteer.jpg')}}" alt="" /><br />المتطوعين </a></li>
                    @endcan
                    @can('partners')
                    <li><a href="{{route('partners.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/volunteer.jpg')}}" alt="" /><br />شركاؤنا </a></li>
                    @endcan
                    @can('info')
                    <li><a href="{{route('info.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/information.png')}}" alt="" /><br />المعلومات</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('courses.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/16.png')}}" alt="" /><br />الكورسات</a></li>
                    @endcan
                    @can('tags')
                    <li><a href="{{route('tags.index')}}" class="boxStyle" >
                          <img src="{{asset('admins/images/icons/3.png')}}" alt="" /><br />كلمات البحث</a></li>
                    @endcan
                    @can('comments')
                    <li><a href="{{route('comments.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/5.jpg')}}" width="75px" alt="" /><br />التعليقات</a></li>
                    @endcan
                    @can('blogs')
                    <li><a href="{{route('blogs.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/2.png')}}" width="75px" alt="" /><br />المنشورات</a></li>
                    @endcan
                    @can('categories')
                    <li><a href="{{route('categories.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/9.png')}}" width="75px" alt="" /><br />الأقسام</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('videos.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/media.png')}}" alt="" /><br />الفيديوهات</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('course.applicants.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/11.png')}}" alt="" /><br />المتقدمين للكورسات</a></li>
                    @endcan
                    @can('site-sections')
                        <li><a href="{{route('site.sections.index')}}" class="boxStyle" >
                                <img src="{{asset('admins/images/icons/9.png')}}" width="75px" alt="" /><br />أقسام الواجهة الأمامية</a></li>
                    @endcan
                    @can('site-content')
                        <li><a href="{{route('site.content.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/10.png')}}" alt="" /><br />محتوي الموقع</a></li>
                    @endcan
                    @can('site-images')
                        <li><a href="{{route('site.images.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}"  alt="" /><br />صور الموقع</a></li>
                    @endcan
                    @can('site-links')
                        <li><a href="{{route('site.links.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/click.jpg')}}" width="64" alt="" /><br />روابط الموقع</a></li>
                    @endcan
                    @can('settings')
                    <li><a href="{{route('settings.index')}}" class="boxStyle">
                            <img src="{{asset('admins/images/icons/settings_lrg.png')}}" width="64" height="64" alt="اعدادات" /><br />اعدادات الموقع</a></li>
                    @endcan
                    <li><a href="" class="boxStyle operation" title="تسجيل الخروج من النظام"><img src="{{asset('admins/images/icons/15.png')}}" alt="" /><br />خروج</a>
                        <form method="post" id="logout" action="{{route('admin.logout')}}" style="display: none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div><!-- Dashboard Gallery End -->
    </div>



@endsection

