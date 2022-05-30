<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Smart CMS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="كلمات البحث مفصولة بفاصلة" />
        <meta name="description" content="وصف مختصر للموقع" />
        <link rel="shortcut icon" href="{{asset('admins/images/favicon.ico')}}" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" title="style" media="screen" href="{{asset('admins/css/style.css')}}" />
        <link rel="stylesheet" type="text/css" title="style" media="screen" href="{{asset('global/admins/css/jquery.hoverscroll.css')}}" />
    <!--[if IE]><link rel="stylesheet" type="text/css" media="screen" href="{{asset('admins/css/ie.css')}}" /><![endif]-->
        {!! RecaptchaV3::initJs() !!}

        <style>
            .grecaptcha-badge { visibility: hidden !important; }
            .pagination li{
                list-style-type: none;
                display: inline;
            }

        </style>
    </head>
    <body>
<div id="container">
    @include('admin.layouts.sidebar')
    @yield('content')
    @include('admin.layouts.footer')
</div><!-- container End -->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('admins/js/clearinput.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery.easyTooltip.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery.tablesorter.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery.hoverscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery.tabbed.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery-ui-2.8.18.blind.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/jquery.fancyfileinputs.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/cms.init.js')}}"></script>  <!-- All jquery plugins initialization & tweaks here -->
<!--[if lte IE 7]
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset('admins/css/ie7.css')}}" />
        <script type="text/javascript">
            /*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></"+"script>"); var __noconflict = true; }
            var IE6UPDATE_OPTIONS = {icons_path: "images/ie6update/"}
        </script>
        <script type="text/javascript" src="{{asset('admins/js/ie6update.js')}}"></script>
    <![endif]-->
<script>
    jQuery(document).ready(function() {
        jQuery("#operation").change(function() {

            var len = jQuery("#group:checked").length;
            if (len < 1) {
                alert("لم تقم باختيار أى عنصر");
                jQuery(".defaultOpt").attr("selected", "selected");
                return false;
            } else {
                if (jQuery("option.delete").is(":selected")) {
                    var answer = confirm('هل أنت متأكد من حذف هذه العناصر؟');
                    if (answer == false) {
                        jQuery(".defaultOpt").attr("selected", "selected");
                        return false;
                    }
                }
                jQuery("#form").submit();
            }
        });
    });
        $(function(){
        $('.operation').on('click',function (e){
            e.preventDefault();
            $(this).next().submit();
        })
    })
</script>

    @stack('scripts')
    </body>
</html>
