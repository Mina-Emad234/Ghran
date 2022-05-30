
<aside>
    <div class="col-md-4">
        <div class="sidebar">

            <div class="arrow_box no-margin"><h3>أخر الأخبار</h3></div>
            <ul class="news-menu margin-top-15">
                @forelse ($all_news as $news)
                    <li><a href="{{route('post.show',$news->slug)}}">
                            @if ($news->image != "" && file_exists("uploads/blogs/" . $news->image))
                                <img src="{{'../../../uploads/blogs/'.$news->image}}" class="img-responsive" />
                            @else
                                <img src="{{asset('admins/images/no-img.png')}}" class="img-responsive"/>
                            @endif
                            <h5 style="font-size: 15px;font-weight: bold;line-height: 20px !important;text-align: center">{{strlen($news->title)>100?substr($news->title,0,strpos($news->title,' ',100)).'...': $news->title}}</h5>
                        </a></li>
                @empty
                    <li><h3 style="text-align: center">لا يوجد أخبار لعرضها حاليا</h3></li>
                @endforelse
            </ul>
            <div class="clearfix"></div>



        </div>

    </div>
</aside>
