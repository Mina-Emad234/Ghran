@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">إضافة صلاحية جديدة </div>
            <br />
            <a href="{{route('roles.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>قائمة الصلاحيات</span>
            </a>

            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif
            <div class="content">
                <form method="POST" action="{{route('roles.store')}}" enctype="multipart/form-data">
                    @csrf
                <fieldset class="form boxStyle">
                    <legend class="boxStyle">إضافة  صلاحية جديدة</legend>

                    <label for="name" class="label">الاسم</label>
                    <input id="name" class="textBox med rnd5" name="name"  />
                    @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                    @enderror
                    <br />

                    <label for="image" class="label">الصلاحيات</label><br>
                    @foreach (config('global.permissions') as $name => $value)
                            <label>
                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $name }}" @if(collect(old('permissions'))->contains($name))) checked @endif>    {{ $value }}
                            </label><br>
                    @endforeach
                        @error('permissions')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
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
