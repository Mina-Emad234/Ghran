@extends('admin.index')
@section('content')
    <div id="middleContent">
        <a href="{{route('admins.index')}}"
           class="button sub inlineBlock rnd3 lightTextShadow">
            <span>قائمة المستخدمين </span>
        </a>
        <div class="block">
            <div class="title lightTextShadow">تحديث مستخدم</div>
            <br />        <!-- Form Start -->
            @if(session()->has('error_msg'))
                <p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
                <br />
            @endif
        <div class="block">
            <div class="content">
                <form method="post" action="{{route('admins.update',$admin->id)}}">
                    @csrf
                    @method('put')
                    <fieldset class="form boxStyle">
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        <legend class="boxStyle">تحديث مستخدم</legend>
                        <label for="name" class="label">اسم المستخدم <em>*</em>:</label>
                        <input type="text" id="name" class="textBox med rnd5" name="name" value="{{old('name',$admin->name)}}"  />
                        @error('name')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br>
                        <label for="email" class="label">البريد الإلكترونى :</label>
                        <input type="text" id="email" class="textBox med rnd5" value="{{old('email',$admin->email)}}" name="email"/>
                        @error('email')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />

                        @if($admin->role->name !== 'admin')
                        <label for="role" class="label">الصلاحية :</label>
                        <select size="1" id="role" name="role_id" class="select med rnd5">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" @if($role->id == $admin->role_id||$role->id==old('role_id')) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>

                        @error('role_id')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        @else
                            <input type="hidden" name="role_id" value="{{$admin->role_id}}">
                        @endif
                        <label for="password" class="label">كلمة المرور :</label>
                        <input type="password" id="password"  class="textBox med rnd5" value="{{old('password')}}" name="password"/>
                        @error('password')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br>
                        <label for="password_confirmation" class="label"> تأكيد كلمة المرور :</label>
                        <input type="password" id="password_confirmation" class="textBox med rnd5" value="{{old('password_confirmation')}}" name="password_confirmation" />
                        @error('password_confirmation')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br>
                        @if(auth()->guard('admin')->user()->name !== $admin->name)
                        <label for="status" class="label"> تفعيل </label>
                        <input type="checkbox" id="status" class="textBox med rnd5" value="1" name="status" @if(old('status',$admin->status)==1) checked @endif/>
                        @else
                            <input name="status" type="hidden" value="{{$admin->status}}">
                        <br>
                        @endif
                        {!! RecaptchaV3::field('admin') !!}
                        @error('g-recaptcha-response')
                        <div style="margin-right: 100px; font-weight: bold; font-size: 12px">{{$message}}</div>
                        @enderror
                        <br />
                        <div class="center">
                            <input id="submit" type="submit" name="submit" value="أدخل" class="button sml inlineBlock rnd5 drkTextShadow" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!-- Form End -->

    </div>
@endsection
