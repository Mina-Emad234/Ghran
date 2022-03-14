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
                    <li><a href="{{route('blog.create')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/add_page.png')}}" alt="" /><br />مقال جديد</a></li>
                    @endcan
                    @can('users')
                    <li><a href="{{route('admin.create')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/add_user.png')}}" alt="" /><br />مستخدم جديد</a></li>
                    @endcan
                    @can('roles')
                    <li><a href="{{route('roles.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/17.png')}}" alt="" /><br />الصلاحيات</a></li>
                    @endcan
                    @can('photos')
                    <li><a href="{{route('photo.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}" alt="" /><br />ألبوم الصور</a></li>
                    @endcan
                    @can('photo_category')
                    <li><a href="{{route('album.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}" alt="" /><br />أقسام الصور</a></li>
                    @endcan
                    @can('contacts')
                    <li><a href="{{route('contact.index')}}" class="boxStyle" title="صندوق الوارد لديك {{\App\Models\Contact::where('read',0)->count()}} رسائل جديدة"><span class="count rnd3">{{\App\Models\Contact::where('read',0)->count()}}</span>
                            <img src="{{asset('admins/images/icons/12.png')}}" alt="" /><br />رسائل واردة</a></li>
                    @endcan
                    @can('mails')
                    <li><a href="{{route('list_mail.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/mailing_list.png')}}" alt="" /><br />القوائم البريدية </a></li>
                    @endcan
                    @can('socials')
                    <li><a href="{{route('scouts.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/volunteer.jpg')}}" alt="" /><br />المتطوعين </a></li>
                    @endcan
                    @can('partner')
                    <li><a href="{{route('partner.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/volunteer.jpg')}}" alt="" /><br />شركاؤنا </a></li>
                    @endcan
                    @can('infos')
                    <li><a href="{{route('info.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/information.png')}}" alt="" /><br />المعلومات</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('course.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/16.png')}}" alt="" /><br />الكورسات</a></li>
                    @endcan
                    @can('tags')
                    <li><a href="{{route('tag.index')}}" class="boxStyle" >
                          <img src="{{asset('admins/images/icons/3.png')}}" alt="" /><br />كلمات البحث</a></li>
                    @endcan
                    @can('comments')
                    <li><a href="{{route('comment.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/5.jpg')}}" width="75px" alt="" /><br />التعليقات</a></li>
                    @endcan
                    @can('blogs')
                    <li><a href="{{route('blog.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/2.png')}}" width="75px" alt="" /><br />المنشورات</a></li>
                    @endcan
                    @can('categories')
                    <li><a href="{{route('category.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/9.png')}}" width="75px" alt="" /><br />الأقسام</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('video.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/media.png')}}" alt="" /><br />الفيديوهات</a></li>
                    @endcan
                    @can('courses')
                    <li><a href="{{route('c_applicant.index')}}" class="boxStyle" >
                            <img src="{{asset('admins/images/icons/11.png')}}" alt="" /><br />المتقدمين للكورسات</a></li>
                    @endcan
                    @can('site_image')
                        <li><a href="{{route('site_image.index')}}" class="boxStyle" ><img src="{{asset('admins/images/icons/8.png')}}" alt="" /><br />صور الموقع</a></li>
                    @endcan
                    @can('settings')
                    <li><a href="{{route('setting.index')}}" class="boxStyle">
                            <img src="{{asset('admins/images/icons/settings_lrg.png')}}" width="64" height="64" alt="اعدادات" /><br />اعدادات الموقع</a></li>
                    @endcan
                    <li><a href="{{route('admin.logout')}}" class="boxStyle" title="تسجيل الخروج من النظام"><img src="{{asset('admins/images/icons/15.png')}}" alt="" /><br />خروج</a></li>
                </ul>
            </div>
        </div><!-- Dashboard Gallery End -->
    </div>



@endsection
