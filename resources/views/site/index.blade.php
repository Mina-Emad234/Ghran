<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{asset('site/img/ico/test.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('site/img/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('site/img/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('site/img/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('site/img/ico/apple-touch-icon-57-precomposed.png')}}">




    <!-- font-awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('site/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <!-- custom CSS -->
    <link href="{{asset('site/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('site/css/resp-fix.css')}}" rel="stylesheet">
    <link href="{{asset('site/css/theme.css')}}" rel="stylesheet">
    <link href="{{asset('site/css/owl.carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('site/css/magnific-popup.css')}}">

    <title>@yield('title')</title>
    @yield('stylesheets')
    <style>
        .grecaptcha-badge { visibility: hidden !important; }
    </style>
    {!! RecaptchaV3::initJs() !!}


</head>

<body>


@include('site.layouts.header')
@yield('content')
@include('site.layouts.footer')




<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="{{asset('site/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->
<script src="{{asset('site/js/ie-emulation-modes-warning.js')}}"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="{{asset('site/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('site/js/respond.min.js')}}"></script>
    <![endif]-->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#inputImage').change(function(){
        let reader = new FileReader();

        reader.onload = (e) => {
            $('#preview-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });



</script>
@stack('scripts')

</body>
</html>
