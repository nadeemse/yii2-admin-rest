<?php

$setting = (new \common\helpers\AppSetting())->getSettings();
$menus = \common\models\Menu::find()->where('parent IS NULL')->with('menus')->all();
?>

<!-- Header -->
<header id="header" class="header-nav-wrapper navbar-scrolltofixed bg-white">
    <div class="header-top bg-theme-colored2 sm-text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget text-white">
                        <ul class="list-inline xs-text-center text-white">
                            <li class="m-0 pl-10 pr-10"> <a href="#" class="text-white"><i class="fa fa-phone text-white"></i> <?= $setting->telephone ?> </a> </li>
                            <li class="m-0 pl-10 pr-10">
                                <a href="#" class="text-white"><i class="fa fa-envelope-o text-white mr-5"></i> <?= $setting->from_email ?> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 pr-0">
                    <div class="widget">
                        <ul class="styled-icons icon-sm pull-right flip sm-pull-none sm-text-center mt-5">

                            <?php if ($setting->facebook) { ?>
                                <li><a target="_blank" href="<?= $setting->facebook ?>"><i class="fa fa-facebook text-white"></i></a></li>
                            <?php } ?>

                            <?php if ($setting->twitter) { ?>
                                <li><a target="_blank" href="<?= $setting->twitter ?>"><i class="fa fa-twitter text-white"></i></a></li>
                            <?php } ?>


                            <?php if ($setting->youtube) { ?>
                                <li><a target="_blank" href="<?= $setting->youtube ?>"><i class="fa fa-youtube text-white"></i></a></li>
                            <?php } ?>


                            <?php if ($setting->instagram) { ?>
                                <li><a target="_blank" href="<?= $setting->instagram ?>"><i class="fa fa-instagram text-white"></i></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <ul class="list-inline sm-pull-none sm-text-center text-right text-white mb-sm-20 mt-10">
                        <li class="m-0 pl-10"> <a href="ajax-load/login-form.html" class="text-white ajaxload-popup"><i class="fa fa-user-o mr-5 text-white"></i> Login /</a> </li>
                        <li class="m-0 pl-0 pr-10">
                            <a href="ajax-load/register-form.html" class="text-white ajaxload-popup"><i class="fa fa-edit mr-5"></i>Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav navbar-sticky navbar-sticky-animated">
        <div class="header-nav-wrapper">
            <div class="container p-0">

                <nav id="menuzord-right" class="menuzord default no-bg">

                    <a class="menuzord-brand switchable-logo pull-left flip mb-15 mt-20" href="/">
                        <img class="logo-default" src="<?= $setting->app_logo ?>" alt="">
                        <img class="logo-scrolled-to-fixed" src="<?= $setting->app_logo ?>" alt="">
                    </a>

                    <ul class="menuzord-menu">

                        <?php foreach($menus as $key =>  $menu) { ?>
                            <li class="<?= $key > 0 ? '' : 'active' ?>">
                                <?= \yii\helpers\Html::a($menu->name, [$menu->route]) ?>
                                <?php if(count($menu->menus) > 0) { ?>
                                    <ul class="dropdown">
                                        <?php foreach($menu->menus as $sub) { ?>
                                            <li>
                                                <a href="<?= $sub->route ?>"><?= $sub->name ?></a>
                                                <?php if(count($sub->menus) > 0) { ?>
                                                    <ul class="dropdown">
                                                        <?php foreach($menu->menus as $innerSub) { ?>
                                                            <li>
                                                                <?= \yii\bootstrap\Html::a($innerSub->name, [$innerSub->route]) ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>