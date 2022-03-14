@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('setting.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة الإعدادات</span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة أو تعديل إعداد </div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('setting.add')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة أو تعديل إعداد</legend>


                        <label class="label">الاسم :</label>
                        <input list="key" value="{{old('key')}}"  class="textBox med rnd5"  name="key">
                        <datalist id="key">
                            @foreach($settings as $setting)
                            <option value="{{$setting->key}}" data-value="{{$setting->value}}">
                            @endforeach
                        </datalist>
                        @error('key')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="chk1" class="label">القيمة</label>
                        <input id="chk1" class="textBox med rnd5" name="value" value="{{old('value')}}">
                        @error('value')
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
<script>
    $(function(){
        $('input[name=key]').change(function(){
            $('#key option').each(function (){
                if($(this).val() === $('[name="key"]').val()){
                    $('input[name=value]').val($(this).data('value'));
                }
            });
        });
    });
</script>
@endsection
