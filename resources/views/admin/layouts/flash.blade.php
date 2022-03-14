<div id="middleContent">

    <div class="block">
@if(session()->has('error_msg'))
<p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('error_msg')}} </p>
<br />
@endif
@if(session()->has('info_msg'))
<p class="block boxStyle notice information"><a href="javascript:void(0)" class="close"></a><b>ملحوظة</b>{{session()->get('info_msg')}} </p>
<br />
@endif
@if(session()->has('notice_msg'))
<p class="block boxStyle notice attention"><a href="javascript:void(0)" class="close"></a><b>تنبيه</b>{{session()->get('notice_msg')}} </p>
<br />
@endif
@if(session()->has('success_msg'))
<p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>تمام</b>{{session()->get('success_msg')}}</p>
<br />
@endif

@if (session()->has('attention_msg'))
<p class="block boxStyle notice tip"><a href="javascript:void(0)" class="close"></a><b>فكرة</b>{{session()->get('attention_msg')}} </p>
<br />
@endif
@if (session()->has('bitauth_error'))
<p class="block boxStyle notice error"><a href="javascript:void(0)" class="close"></a><b>خطأ</b>{{session()->get('bitauth_error')}} </p>
<br />
@endif

@if(session()->has('message'))
<p class="block boxStyle notice succeed"><a href="javascript:void(0)" class="close"></a><b>ملحوظة</b>{{session()->get('message')}}</p>
<br />
@endif
    </div>
</div>


