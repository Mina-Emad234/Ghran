@extends('site.index')
@section('title','شركاؤنا')
@section('content')
    <div class="partners">
        <div class="container">

            <div class="heading">
                <h3>شــــــركاؤنا</h3>
                <span class="diver"></span>
            </div>
            @if(count($partners)>0)
            <div class="owl-carousel" id="partners">
                @foreach ($partners as $partner)
                <div class="col-3 margin-bottom-30">
                    <div class="partner-box">
                        @if($partner->image != "" && file_exists("uploads/partners/" . $partner->image))
                            <img src="{{'../../../uploads/partners/'.$partner->image}}" class="img-responsive" />
                        @else
                            <img src="{{asset('admins/images/no-img.png')}}" class="img-circle img-responsive" />
                        @endif
                        <h3>{{$partner->name}}</h3>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <h4 style="text-align: center">لا يوجد شركاء لعرضهم في الوقت الحالي</h4>
            @endif
        </div>
    </div><!--/.partners  -->
@endsection
