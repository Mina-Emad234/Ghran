<footer>

    <div class="footer-top">
        <div class="container">
            @php
                $image=\App\Models\SiteSection::with('image')->where('name','footer_logo')->first()->image->image;
            @endphp
            <div class="col-md-9">
                <img src="{{asset('site/img/'.$image)}}" class="img-responsive margin-bottom-15"/>
                <p>تعد التنمية بمفهومها العام عملية واعية موجهة لصياغة بناء حضاري اجتماعي متكامل يؤكد فيه المجتمع هويته وذاتيته وإبداعه .</p>
            </div>

            <div class="col-md-3">

                <span class="incorrect">
                @if(session()->has('success'))
                    <div class="alert alert-info">
                        <strong>{{session()->get('success')}}</strong>
                    </div>
                @endif
                @if(isset($_COOKIE['mail_sent']))
                    <div class="alert alert-info">
                        <strong>تم إضافة حساب من قبل</strong>
                    </div>
                @endif
                    @if(session()->has('error'))
                <div class="alert alert-danger">
                    <strong>{{session()->get('error')}}</strong>
                </div>
                    @endif
                </span><br />
                    <form method="POST" action="{{route('send_mail')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="الاسم">
                            @error('name')
                            <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="mail" value="{{old('mail')}}" class="form-control" placeholder="البريد الالكتروني ">
                            @error('mail')
                            <p><strong>{{$message}}</strong></p>
                            @enderror

                        </div>

                        {!! RecaptchaV3::field('mail') !!}
                        @error('g-recaptcha-response')
                        <p><strong>{{$message}}</strong></p>
                        @enderror

                        <input @if(!isset($_COOKIE['mail_sent'])) type="submit" @endif  class="btn btn-custom btn-block" value="الاشتراك بالنشرة البريدية">
                    </form>
            </div>
        </div>
    </div>




    <div class="footer-middel">
        <div class="container">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul class="list-footer">
                    <li class="head">عن الموقع</li>
                    <li><a href="{{route('pages.about')}}">نبذه عنا</a></li>
                    <li><a href="{{route('pages.members')}}">أعضاء اللجنة</a></li>
                    <li><a href="{{route('pages.map')}}">خريطة الموقع</a></li>
                    <li><a href="{{route('search.page')}}">البحث</a></li>
                    <li><a href="{{route('pages.info')}}">معلومات</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul class="list-footer">
                    <li class="head">المحتوى</li>
                    <li><a href="{{route('home')}}">الرئيسية</a></li>
                    <li><a href="{{route('post.index')}}">المنشورات</a></li>
                    <li><a href="{{route('partners.index')}}">شركائنا</a></li>
                    <li><a href="{{route('course_free.all')}}">الكورسات المجانية</a></li>
                    <li><a href="{{route('course_payable.all')}}">الكورسات المدفوعة</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul class="list-footer">
                    <li class="head">المشاركة</li>
                    <li><a href="{{route('scout.register')}}">التسجيل في الكشافة</a></li>
                    <li><a href="{{route('media.register')}}">الانتساب للمركز الإعلامي</a></li>
                    <li><a href="{{route('volunteer.register')}}">الانتساب للفريق التطوعي</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container text-center copyright"><p>جميع الحقوق محفوظة لجنة التنمية الاجتماعية الأهلية بغران © 2015</p></div>

</footer>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{asset('site/js/ie10-viewport-bug-workaround.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('site/js/responsive-tabs.js')}}"></script>
<script src="{{asset('site/js/owl.carousel.js')}}"></script>
<script src="{{asset('site/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('site/js/tickerme.min.js')}}"></script>
<script src="{{asset('site/js/map.js')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=myMap&language=ar&region=EG
         async defer"></script>
<script src="{{asset('site/js/main.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('#ticker').tickerme();
    });
</script>
