@extends('admin.index')
@section('content')
    <div id="middleContent">

        <div class="block">
            <div class="title lightTextShadow">تحديث الصلاحية</div>
            <br />
            <a href="{{route('roles.index')}}" class="button sub inlineBlock rnd3 lightTextShadow">
                <span>قائمة الصلاحيات</span>
            </a>
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif

            <div class="content">
                <form method="POST" action="{{route('roles.update',$role->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <legend class="boxStyle">تحديث الصلاحية</legend>

                        <label for="name" class="label">الاسم</label>
                        <input id="name" value="{{old('name',$role->name)}}" class="textBox med rnd5" name="name"  />
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        <label for="image" class="label">الصلاحيات</label><br>
                        @foreach (config('global.permissions') as $name => $value)
                            <label>
                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $name }}" @if(in_array($name, $role->permissions) || collect(old('permissions'))->contains($name))) checked @endif>    {{ $value }}
                            </label><br>
                        @endforeach
                        @error('permissions')
                        <div style="font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        {!! RecaptchaV3::field('roles') !!}
                        @error('g-recaptcha-response')
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
