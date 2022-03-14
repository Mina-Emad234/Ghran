@extends('admin.index')
@section('content')

    <div id="middleContent">
        <a href="{{route('site_image.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة صور الموقع</span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">إضافة أو تعديل صورة للموقع </div>
            <br />

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('site_image.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form boxStyle">
                        <legend class="boxStyle">إضافة أو تعديل صورة للموقع</legend>


                        <label class="label">قسم الموقع :</label>
                        <select size="1" name="site_part" class="select med rnd5">
                                <option value="main" @if(old('site_part')=='main') selected @endif>main</option>
                                <option value="support" @if(old('site_part')=='support') selected @endif>support</option>
                        </select>

                        @error('site_part')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <label for="image" class="label">الصورة</label>
                        <div class="fileUpload">
                            <input id="file" type="file" name="image"   />
                            <span class="button rnd5 drkTextShadow">جلب الملف</span>
                            @error('image')
                            <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                            @enderror
                        </div>
                        <br />
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
