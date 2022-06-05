<div class="top-nav">
    <div class="container">
        <div class="pull-right">
            <p class="date-header">
                <script src="{{asset('site/js/hijri.js')}}"></script>

            </p>
        </div>
        <div class="pull-left">
            <ul class="social-header">
                @if(!empty(config()->get('app.facebook')))
                    <li><a rel="nofollow" target="_blank" href="{{config()->get('app.facebook')}}"><i class="fa fa-facebook"></i></a></li>
                @endif
                @if(!empty(config()->get('app.twitter')))
                    <li><a rel="nofollow" target="_blank" href="{{config()->get('app.twitter')}}"><i class="fa fa-twitter"></i></a></li>
               @endif
                @if(!empty(config()->get('app.youtube')))
                   <li><a rel="nofollow" target="_blank" href="{{config()->get('app.youtube')}}"><i class="fa fa-youtube"></i></a></li>
                @endif
                @if(!empty(config()->get('app.instagram')))
                    <li><a rel="nofollow" target="_blank" href="{{config()->get('app.instagram')}}"><i class="fa fa-instagram"></i></a></li>
                @endif

            </ul>
        </div>
    </div>
</div>


<div class="middel-nav">
    <div class="container">
        @if($image)
        <a href="#" class="logo"><img src="{{asset('site/img/'.$image->image->image)}}"/></a>
        @else
        <a href="#" class="logo"><img src="{{asset('admins/images/no-img.png')}}" height="90" width="460"/></a>
        @endif
        <form action="{{route('search')}}" method="get" >
            @csrf
            <div class="col-sm-4 pull-left margin-top-30 search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="ادخل كلمة البحث ...">
                    {!! RecaptchaV3::field('search') !!}
                    <span class="input-group-btn">
                    <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                  </span>
                </div><!-- /input-group -->
            </div>
        </form>


    </div></div><!-- /.container -->
</div></div><!-- /.middel-nav  -->




<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if($links)
                     @foreach($links->links as $link)


                @if(count($link->_child)==0 && $link->parent_id == NULL)
                        <li><a href="{{url($link->link)}}">{{$link->name}}</a></li>
                    @elseif(count($link->_child)>0)
                        <li class="dropdown">
                            <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$link->name}}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($link->_child as $child)
                                <li><a href="{{url($child->link)}}">{{$child->name}}</a></li>
                                    @endforeach
                            </ul>
                        </li>
                    @endif
            @endforeach
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</nav>
@push('scripts')
<script>
    $(function (){
        $('#navbar ul li').on('click',function () {
            $('#navbar ul li').removeClass('active');
            $(this).addClass('active');
        });
        $.each($('#navbar ul li a'), function() {
            if(location.href === $(this).attr('href')){
                $(this).parent().addClass('active');
            }
        });

    });
</script>
@endpush
