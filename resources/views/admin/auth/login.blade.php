<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Smart CMS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="كلمات البحث مفصولة بفاصلة" />
    <meta name="description" content="وصف مختصر للموقع" />
    <link rel="shortcut icon" href="{{asset('admins/images/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" title="style" media="screen" href="{{asset('admins/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" title="style" media="screen" href="{{asset('admins/css/jquery.hoverscroll.css')}}" />
    <link rel="stylesheet" type="text/css" title="style" media="screen" href="{{asset('admins/css/jquery.cleditor.css')}}" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!--[if IE]><link rel="stylesheet" type="text/css" media="screen" href="{{asset('admins/css/ie.css')}}" /><![endif]-->
<!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" media="screen" href="{{asset('admins/css/ie7.css')}}" />
            <script type="text/javascript">
                /*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></"+"script>"); var __noconflict = true; }
                var IE6UPDATE_OPTIONS = {icons_path: "images/ie6update/"}
            </script>
            <script type="text/javascript" src="{{asset('admins/js/ie6update.js')}}"></script>
        <![endif]-->

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
    <script type="text/javascript" src="{{asset('admins/js/jquery.2.4.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/clearinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.easyTooltip.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.tablesorter.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.hoverscroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.tabbed.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery-ui-2.8.18.blind.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.cleditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/js/cms.init.js')}}"></script> <!-- All jquery plugins initialization & tweaks here -->
    {!! RecaptchaV3::initJs() !!}
</head>
<body>
<div id="loginPage">
    <img src="{{asset('admins/images/logo.png')}}" alt="" class="logo"/>
    <!-- Login Start -->
    <div class="login boxStyle">
        <form action="{{route('login')}}" method="post" >
            @csrf

            <fieldset class="form">
                @if(session()->has('auth_error'))
                    <span class="text-danger">{{session()->get('auth_error')}}</span><br>
                @endif
                @error('email')
                <span class="text-danger">{{$message}}</span><br>
                @enderror
                @error('password')
                <span class="text-danger">{{$message}}</span><br>
                @enderror
                @error('g-recaptcha-response')
                    <span class="text-danger">{{$message}}</span><br>
                @enderror
                <legend>&nbsp;</legend>
                <div class="form-group">
                    <input id="name" value="{{old('email')}}" class="form-control" placeholder="email" name="email"/>
                </div>
                <div class="form-group">
                     <input id="password" value="{{old('password')}}" type="password" class="form-control" placeholder="password" name="password" /><br /><br />
                </div>
                <input type="checkbox" id="chk2" name="remember_me" value="1"/>
                <label for="chk2">تذكرني</label><br />
                    <style>
                        .grecaptcha-badge { visibility: hidden !important; }
                    </style>
                    {!! RecaptchaV3::field('login') !!}

                <div class="center">
                    <input id="submit" type="submit" name="login" value="أدخل" class="button inlineBlock sml rnd5 drkTextShadow" />
                </div>
            </fieldset>
        </form>
    </div><!-- Login End -->
</div>

<?php
?>
</body>
</html>

