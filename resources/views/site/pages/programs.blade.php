@extends('site.index')
@section('title','برامجنا')
@section('content')
    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">برامجنا</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">برامجنا</li>
            </ul>
        </div>
    </div>


    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">



                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title acc-head active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">مركز بث الإعلامي ( جميع المبادرات )</h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">

                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">ديوانية الأهالي الاجتماعية ( مبادرة جاري )</h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">ساند للمسوح الاجتماعية ( مبادرة ساند )</h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="4">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col4" aria-expanded="false" aria-controls="col4">صامد لذوي الاحتياجات الخاصة</h4>
                            </div>
                            <div id="col4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="4">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="5">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col5" aria-expanded="false" aria-controls="col5">الحي الصحي</h4>
                            </div>
                            <div id="col5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="5">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="6">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col6" aria-expanded="false" aria-controls="col6">في ضيافـتـنـــــــا فتـــاة ( مبادرة إنتاجي )</h4>
                            </div>
                            <div id="col6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="6">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="7">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col7" aria-expanded="false" aria-controls="col7">برنامج مدرسة الأجيال للسيدات ( الرائدة الإجتماعية )</h4>
                            </div>
                            <div id="col7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="7">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="8">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col8" aria-expanded="false" aria-controls="col8">( كشافة تنمية عرقة )</h4>
                            </div>
                            <div id="col8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="8">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="9">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col9" aria-expanded="false" aria-controls="col9">محاضرات ( لوطني .. أنتمي ) ( مبادرة جاري )</h4>
                            </div>
                            <div id="col9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="9">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="10">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col10" aria-expanded="false" aria-controls="col10">نادي تنمية عرقة ( مبادرة جاري )</h4>
                            </div>
                            <div id="col10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="10">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="11">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col11" aria-expanded="false" aria-controls="col11">وقاية لحماية المجتمع من التدخين والإدمان</h4>
                            </div>
                            <div id="col11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="11">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="12">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col12" aria-expanded="false" aria-controls="col12">تأهيل الشباب والفتيات المقبلين على الزواج ( مبادرة تأهيل المقبلين على الزواج )</h4>
                            </div>
                            <div id="col12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="12">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="13">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col13" aria-expanded="false" aria-controls="col13">مركز حلول للاستشارات الاجتماعية ( مبادرة إرشاد )</h4>
                            </div>
                            <div id="col13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="13">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="14">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col14" aria-expanded="false" aria-controls="col14">مركز ثروة وطن للشباب ( مبادرة جاري )</h4>
                            </div>
                            <div id="col14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="14">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="15">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col15" aria-expanded="false" aria-controls="co115">مركز في بيتنا مبدع / مبدعة ( مبادرة إنتاجي )</h4>
                            </div>
                            <div id="col15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="15">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="16">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col16" aria-expanded="false" aria-controls="col16">مركز تواصل وبناء لتنمية الأسرة ( مبادرة إرشاد )</h4>
                            </div>
                            <div id="col16" class="panel-collapse collapse" role="tabpanel" aria-labelledby="16">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="17">
                                <h4 class="panel-title collapsed acc-head" data-toggle="collapse" data-parent="#accordion" href="#col17" aria-expanded="false" aria-controls="col17">دعم تشغيل مقر لجنة التنمية الاجتماعية الأهلية بعرقه</h4>
                            </div>
                            <div id="col17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="17">
                                <div class="panel-body">
                                    <h4>الأهداف :</h4>
                                    <p>تفعيل لجميع المبادرات التنموية -فتح قنوات اتصال مباشرة مع المجتمع المحلي والقطاعين الحكومي والأهلي للاستفادة من إمكانياتهم لتحقيق الشراكة المجتمعية-إبراز برامج اللجان والخدمات التي تؤديها -تسويق منتجات الأسر المنتجة من خلال الشبكة الالكترونية -تصميم مواقع على الشبكة الإلكترونية للتدريب والتأهيل عن بعد</p>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="clearfix"></div>

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
@endsection
