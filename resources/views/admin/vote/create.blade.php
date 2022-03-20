@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('v_question.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة الإستفتاءات </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة إستفتاء جديد</div>
            <br />
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif


            <div class="content">
                <form method="POST" action="{{route('v_question.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة إستفتاء جديد</legend>


                        <label class="label">السؤال :</label>
                        <input type="text" name="question" value="{{old('question')}}">
                        @error('question')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الإجابة الأولى :</label>
                        <input type="text" name="answer1" value="{{old('answer1')}}">
                        @error('answer1')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الإجابة الثانية :</label>
                        <input type="text" name="answer2" value="{{old('answer2')}}">
                        @error('answer2')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الإجابة الثالثة :</label>
                        <input type="text" name="answer3" value="{{old('answer3')}}">
                        @error('answer3')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label class="label">الإجابة الرابعة :</label>
                        <input type="text" name="answer4" value="{{old('answer4')}}">
                        @error('answer4')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">تفعيل</label>
                        <input type="checkbox" name="active" id="chk1" value="1" @if(old('active')==1) checked @endif/>
                        <br />
                        {!! RecaptchaV3::field('vote') !!}
                        @error('g-recaptcha-response')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <div class="center">
                            <input id="submit" type="submit" value="أدخل" class="button sml inlineBlock rnd5 drkTextShadow" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

@endsection
