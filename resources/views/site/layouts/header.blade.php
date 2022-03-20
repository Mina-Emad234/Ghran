<div class="top-nav">
    <div class="container">
        <div class="pull-right">
            <p class="date-header">
                <script src="{{asset('site/js/hijri.js')}}"></script>

            </p>
        </div>
        <div class="pull-left">
            <ul class="social-header">
                @php
                    $setting=new \App\Models\Setting();
                @endphp

                    <li><a rel="nofollow" target="_blank" href="{{$setting->val('Facebook')}}"><i class="fa fa-facebook"></i></a></li>
                    <li><a rel="nofollow" target="_blank" href="{{$setting->val('Twitter')}}"><i class="fa fa-twitter"></i></a></li>
                    <li><a rel="nofollow" target="_blank" href="{{$setting->val('Youtube')}}"><i class="fa fa-youtube"></i></a></li>
                    <li><a rel="nofollow" target="_blank" href="{{$setting->val('Instagram')}}"><i class="fa fa-instagram"></i></a></li>

            </ul>
        </div>
    </div>
</div>


<div class="middel-nav">
    <div class="container">
        @php
            $image=\App\Models\SiteSection::with('image')->where('name','header_logo')->first()->image->image;
        @endphp
        <a href="#" class="logo"><img src="{{asset('site/img/'.$image)}}"/></a>
        <form action="{{route('search')}}" method="post" >
            @csrf
            <div class="col-sm-4 pull-left margin-top-30 search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="ادخل كلمة البحث ...">
                    {!! RecaptchaV3::field('search') !!}
                    <span class="input-group-btn">
                    <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                  </span>
                </div><!-- /input-group -->
            </div>
        </form>


    </div></div><!-- /.container -->
</div></div><!-- /.middel-nav  -->




<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li><a href="{{route('post.index')}}">المنشورات</a></li>
                <li><a href="{{route('album_cat.index')}}">الاستوديو</a></li>
                <li><a href="{{route('pages.about')}}">عن اللجنة</a></li>
                <li><a href="{{route('pages.programs')}}">برامجنا</a></li>
                <li class="dropdown">
                    <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">تطـوع معنـا <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('scout.register')}}">التسجيل في الكشافة</a></li>
                        <li><a href="{{route('media.register')}}">الانتساب للمركز الإعلامي</a></li>
                        <li><a href="{{route('volunteer.register')}}">الانتساب للفريق التطوعي</a></li>
                    </ul>
                </li>
                <li><a href="{{route('partners.index')}}">شركاؤنا</a></li>
                <li><a href="{{route('pages.support')}}">ادعمنا</a></li>
                <li><a href="{{route('contact.register')}}" class="last">اتصل بنا</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</nav>
@push('scripts')
<script>
    $(function (){
        $('#navbar ul li').on('click',function () {
            $('#navbar ul li').removeClass('active');
            $(this).addClass('active');
        });
        $.each($('#navbar ul li a'), function() {
            if(location.href === $(this).attr('href')){
                $(this).parent().addClass('active');
            }
        });

    });
</script>
@endpush
