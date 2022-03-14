@extends('site.index')
@section('title',$blog->title)
@section('content')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <link href="{{asset('admins/ckeditor/plugins/codesnippet/lib/highlight/styles/atelier-seaside.light.css')}}" rel="stylesheet">
    <script src="{{asset('admins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js')}}"></script>

    <script type='text/javascript'>
        $(document).ready(function () {
            $('pre code').each(function (i, block) {
                hljs.highlightBlock(block);
            });
        });
    </script>

    <div class="slider_bg">
        <div class="banner-inner">
            <div class="container">
                <ul class="breadcrumb pull-left">
                    <li><a href="{{route('home')}}">الرئيسية</a></li>
                </ul>
                <h2>{{$blog->category->name}}</h2>
            </div>
        </div>
    </div>

    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">
                    <div class="b_right">
                        <h4>{{$blog->title}}.</h4>
                    </div>
                    <div >
                        @if ($blog->image != "" && file_exists("uploads/blogs/" . $blog->image))
                        <img class="img-responsive suport"  src="{{'../../../uploads/blogs/'.$blog->image}}"
                             width="516" height="233"/>
                        @else
                        <img class="img-responsive suport"  src="{{asset('admins/images/no-img.png')}}" width="516"
                             height="233"/>
                        @endif
                    </div>
                    <div>
                        {!! $blog->body !!}
                        <span class='st_facebook_hcount' displayText='Facebook' st_title='{{$blog->title}}'
                              st_image='{{'../../../uploads/blogs/'.$blog->image}}'></span>
                        <span class='st_twitter_hcount' displayText='Tweet' st_title='{{$blog->title}}'
                              st_image='{{'../../../uploads/blogs/'.$blog->image}}'></span>
                        <span class='st_googleplus_hcount' displayText='Google +' st_title='{{$blog->title}}'
                              st_image='{{'../../../uploads/blogs/'.$blog->image}}'></span>
                        <span style="font-size: 15px; font-weight: bold; float: left"> <i class="date"> </i><span>تاريخ النشر {{ date(" F j, Y ", strtotime($blog->created_at))}}</span>.</a></span>
                    </div>
                    <div>
                        @if(!empty($blog->tags))
                        <h3>إقتراحات البحث</h3>
                        @foreach ($blog->tags as $tag)
                        <span class="bg-primary" style="padding: 6px; border: 1px solid #333;border-radius: 50px"><a href="{{route('tag_blog.index',$tag->slug)}}">{{$tag->name}}</a></span>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <aside>
                <div class="col-md-4">
                    <div class="sidebar">

                        <div class="arrow_box no-margin"><h3>أخر الأخبار</h3></div>
                        <ul class="news-menu margin-top-15">
                            @php
                                $all = \App\Models\Blog::where(['active'=>1,'category_id'=>2])->latest()->limit(6)->get();
                            @endphp
                            @forelse ($all as $news)
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



        </div>
    </section>

    <section class="gray">
        <div class="container">
            <div class="col-md-8">
                <div class="box-vote-content">
                    @if(session()->has('success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('success')}}</strong>
                        </div>
                    @endif
                        @if(session()->has('error_msg'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('error_msg')}}</strong>
                        </div>
                    @endif
                    @if (count($blog->comments) != 0)
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title acc-head active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">التعليقات <span>{{$blog->comments_count}}</span></h4>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            @foreach ($blog->comments as $parent)
                                            <div class="hero-unit container box-vote-content" style="width: 850px; margin-right: 100px">
                                                <h4>{{$parent->writer}}</h4>
                                                <p>{{$parent->body}}</p>
                                                <span>تم نشر في {{ date(" F j, Y ", strtotime($parent->created_at))}}</span>
                                                <span style="padding-right: 200px"><a href='#comment_form' class='reply' id='{{$parent->id}}'>رد</a></span>
                                                <span>
                                                     @if(isset($_COOKIE['comment_email']))
                                                    ، <a href='{{route('delete_comment',$parent->id)}}' class='reply'>حذف</a></span>
                                                    ، <a href="javascript:void(0)" class='edit' data-id='{{$parent->id}}' data-body="{{$parent->body}}">تحديث</a></span>
                                                @endif
                                                <div>
                                                    @if (count($parent->_child) > 0)
                                                    @foreach ($parent->_child as $child)
                                                    <div class="hero-unit container box-vote-content" style="width: 850px0">
                                                        <h4>{{$child->writer}}</h4>
                                                        <p>{{$child->body}}</p>
                                                        <span>تم نشر في {{ date(" F j, Y ", strtotime($child->created_at))}}</span>
                                                        <span style="padding-right: 200px"><a href='#comment_form' class='child_reply' id='child'>رد</a></span>
                                                        <span>
                                                            @if(isset($_COOKIE['comment_email']))
                                                            | <a href='{{route('delete_comment',$child->id)}}' class='reply'>حذف</a></span>
                                                            | <a href="javascript:void(0)" class='edit' data-id='{{$child->id}}' data-body="{{$child->body}}">تحديث</a></span>
                                                            @endif
                                                    </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title acc-head active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">التعليقات <span>(0)</span></h4>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">

                                            <div class="hero-unit container box-vote-content" style="width: 850px; margin-right: 100px">
                                                <h4>لا توجد تعليقات لهذا المنشور</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>

            <aside>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="arrow_box no-margin"><h3 id="form_head">أضف تعليق.</h3></div>
                        <div class="box-vote-content">
                            @if(session()->has('error'))
                                <div class="alert alert-error">
                                    <strong>{{session()->get('error')}}</strong>
                                </div>
                            @endif
                            @if(isset($_COOKIE['comment_writer']) && isset($_COOKIE['comment_email']))
                                    <form class="add_comm" action="{{route('add_comment',$blog->slug)}}" method='post'>
                                        @csrf
                                            <input type="hidden" name="writer" id='name' value="{{$_COOKIE['comment_writer']}}"/>
                                            <input type="hidden" name="email" value="{{$_COOKIE['comment_email']}}" id='email'/>
                                        <div class="form-group">
                                            <label for="comment">التعليق:</label>
                                            <textarea class="form-control" name="body" id='comment'>{{old('body')}}</textarea>
                                            @error('body')
                                            <p><b>{{$message}}</b></p>
                                            @enderror
                                            <input type='hidden' name='parent_id' value="{{old('parent_id',NULL)}}" id='parent_id' />
                                            <input type='hidden' name='blog_id' value="{{$blog->id}}" id='parent_id'/>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-custom btn-block" name="submit" value="أضف تعليق"/>
                                        </div>
                                    </form>
                                @else
                                 <form class="add_comm" action="{{route('add_comment',$blog->slug)}}" method='post'>
                                @csrf
                                <div class="form-group">
                                    <label for="comment_name">الاسم:</label>
                                    <input class="form-control" type="text" name="writer" id='name' value="{{old('writer')}}"/>
                                    @error('writer')
                                    <p><b>{{$message}}</b></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">الإيميل:</label>
                                    <input class="form-control" type="text" name="email" value="{{old('email')}}" id='email'/>
                                    @error('email')
                                    <p><b>{{$message}}</b></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="comment">التعليق:</label>
                                    <textarea class="form-control" name="body" id='comment'>{{old('body')}}</textarea>
                                    @error('body')
                                    <p><b>{{$message}}</b></p>
                                    @enderror
                                    <input type='hidden' name='parent_id' value="{{old('parent_id',NULL)}}" id='parent_id' />
                                    <input type='hidden' name='blog_id' value="{{$blog->id}}" id='parent_id'/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-custom btn-block" name="submit" value="أضف تعليق"/>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>

            </aside>
        </div>
    </section>



    <?php //$this->view('blog/blog/comment'); ?>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({
            publisher: "20be3210-c992-4519-8a0c-aad909ea5654",
            doNotHash: false,
            doNotCopy: false,
            hashAddressBar: false
        });</script>
    <script type='text/javascript'>
        $(function () {
            $("a.reply").click(function () {
                var id = $(this).attr("id");
                $("#parent_id").attr("value", id);
                $("#comment").focus();
            });
            $("a.child_reply").click(function () {
                var id = $("a.reply").attr("id");
                $("#parent_id").attr("value", id);
                $("#comment").focus();
            });
            $('a.edit').click(function (){
                var id = $(this).data("id");
                var body = $(this).data("body");
                $('.add_comm input[name="id"]').remove();
                $('.add_comm .new_comment').remove();
                $('.add_comm').attr('action','{{route('edit_comment',$blog->slug)}}');
                $("#form_head").html('تحديث تعليق.');
                $(`<input type="hidden" name="id" value="${id}">`).insertAfter(".add_comm input[name='_token']");
                $('.add_comm input[type="submit"]').val("تحديث");
                $('form.add_comm').append(`<a href='javascript:void(0);' class="btn btn-custom btn-block new_comment">إضغط لإضافة تعليق جديد</a>`);
                $("#comment").val(body).focus();
            });

            $(document).on('click','a.new_comment',function (){
                $('.add_comm input[name="id"]').remove();
                $('.add_comm .new_comment').remove();
                $('.add_comm').attr('action','{{route('add_comment',$blog->slug)}}');
                $("#form_head").html('أضف تعليق.');
                $('.add_comm input[type="submit"]').val("أضف تعليق");
                $("#comment").val('').focus();
            });
        });
    </script>
@endsection
