<footer>

    <div class="footer-top">
        <div class="container">

            <div class="col-md-9">
                <img src="{{asset('site/img/'.$image)}}" class="img-responsive margin-bottom-15"/>
                {!!  $content !!}
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
                    @foreach($about_links as $link)
                        <li><a href="{{url($link->link)}}">{{$link->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul class="list-footer">
                    <li class="head">المحتوى</li>
                    @foreach($content_links as $link)
                        <li><a href="{{url($link->link)}}">{{$link->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <ul class="list-footer">
                    <li class="head">المشاركة</li>
                    @foreach($social_links as $link)
                    @if(count($link->_child)>0)

                            @foreach($link->_child as $child)
                                <li><a href="{{url($child->link)}}">{{$child->name}}</a></li>
                            @endforeach

                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container text-center copyright">{!!   $footer_content !!}</div>

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
