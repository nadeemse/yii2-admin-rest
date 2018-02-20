<?php

use common\models\News;

$setting = (new \common\helpers\AppSetting())->getSettings();

$news = News::find()->orderBy(['id' => SORT_DESC])->limit(3)->all();
$menus = \common\models\Menu::find()->where('parent IS NULL')->with('menus')->all();

?>
<!-- Footer -->
<footer id="footer" class="footer layer-overlay overlay-dark-9 parallax border-top-theme-colored2-5px" data-bg-img="/images/bg/bg1.jpg">
    <div class="container pt-70 pb-40">
        <div class="row">
            <div class="col-md-3">
                <div class="widget dark">

                    <img alt="" src="<?= $setting->footer_logo ?>">
                    <p class="font-12 mt-20 mb-20"><?= substr($setting->about, 0, 200). '...' ?></p>
                    <a class="btn btn-default btn-sm btn-transparent mt-0" href="#">Read More</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="widget dark">
                            <h4 class="widget-title">Useful Links</h4>
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <ul>

                                        <?php foreach($menus as $key =>  $menu) { ?>
                                            <li class="<?= $key > 0 ? '' : 'active' ?>">
                                                <?= \yii\helpers\Html::a($menu->name, [$menu->route]) ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <ul>
                                        <li><a href="#">Business</a></li>
                                        <li><a href="#">Finance</a></li>
                                        <li><a href="#">Consulting</a></li>
                                        <li><a href="#">Insurance</a></li>
                                        <li><a href="#">Professional</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="widget dark">
                            <h4 class="widget-title">Latest News</h4>
                            <div class="latest-posts">

                            <?php foreach($news as $new) { ?>
                                <article class="post media-post clearfix pb-0 mb-10">
                                    <a class="post-thumb" href="/news/<?= $new->id ?>">
                                        <img src="<?= $new->banner ?>" alt="" width="100">
                                    </a>
                                    <div class="post-right">
                                        <h5 class="post-title mt-0 mb-5"><a href="/news/<?= $new->id ?>"><?= $new->title ?></a></h5>
                                        <p class="post-date mb-0 font-12"><?= Yii::$app->formatter->asDate($new->created_at) ?></p>
                                    </div>
                                </article>
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="widget dark">
                            <h4 class="widget-title">Opening Hours</h4>
                            <div class="opening-hours">
                                <ul class="list-border">
                                    <li class="clearfix"> <span> Mon - Tues :  </span>
                                        <div class="value pull-right"> 6.00 am - 10.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Wednes - Thurs :</span>
                                        <div class="value pull-right"> 8.00 am - 6.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Fri : </span>
                                        <div class="value pull-right"> 3.00 pm - 8.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Sun : </span>
                                        <div class="value pull-right bg-theme-colored2 text-white closed"> Closed </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom" data-bg-color="#253039">
        <div class="container pt-20 pb-20">
            <div class="row">

                <div class="col-md-6">
                    <p class="font-12 sm-text-center text-black-777 m-0">
                        <?= $setting->copyright_text ?>
                    </p>
                </div>

                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12">
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">Help Desk</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>