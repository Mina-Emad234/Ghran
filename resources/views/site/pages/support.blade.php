@extends('site.index')
@section('title','ادعمنا')
@section('content')
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">ادعمنا</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">ادعمنا</li>
            </ul>
        </div>
    </div>


    <section class="inner">
        <div class="container">
            <img class="img-responsive suport" src="{{asset('site/img/banner-support.jpg')}}"/>
            <h3>حساب اللجنة في مصرف الراجحي رقم IBAN</h3>
            <p>​SA6880000349608010322238</p>
            <br/>
            <h4>صفحة لجنة التنمية الاجتماعية بغران على موقع الخبر الشامل</h4>
            <a href="http://www.gg.org.sa/donor/viewcharityorganization?organizationId=915" target="_blank">
                http://www.gg.org.sa/donor/viewcharityorganization?organizationId=915
            </a>




        </div>

    </section>
@endsection
