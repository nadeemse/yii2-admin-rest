<?php

use yii\helpers\Html;
use api\core\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'DuConsulting';
?>

<!-- Section: home -->
<section id="home">
    <div class="container-fluid p-0">

        <?php if($banner !== null && count($banner->bannerImages) > 0) { ?>

            <!-- START REVOLUTION SLIDER 5.0.7 -->
            <div id="rev_slider_home_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34" style="margin:0px auto; background-color:#ffffff; padding:0px; margin-top:0px; margin-bottom:0px;">
                <!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
                <div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                    <ul>

                        <?php foreach($banner->bannerImages as $key => $slide) { $i = 1; ?>

                            <!-- SLIDE 1 -->
                            <li data-index="rs-<?= $key ?>" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?= $slide->image ?>" data-rotate="0"  data-fstransition="fade" data-saveperformance="off" data-title="Web Show" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="<?= $slide->image ?>" alt="<?= $slide->title ?>" data-bgposition="center 30%" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 bg-theme-colored-transparent-1"
                                     id="slide-<?= $key ?>-layer-<?= $i ?>"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                     data-width="full"
                                     data-height="full"
                                     data-whitespace="normal"
                                     data-transform_idle="o:1;"
                                     data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;"
                                     data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1500;e:Power3.easeInOut;"
                                     data-start="0"
                                     data-basealign="slide"
                                     data-responsive_offset="on"
                                     style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);">
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption tp-resizeme rs-parallaxlevel-0 text-white text-uppercase font-roboto-slab font-weight-700"
                                     id="slide-<?= $key ?>-layer-<?= $i + 1 ?>"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['top','top','top','top']" data-voffset="['195','195','160','170']"
                                     data-fontsize="['48','42','38','28']"
                                     data-lineheight="['70','60','50','45']"
                                     data-fontweight="['800','700','700','700']"
                                     data-textalign="['center','center','center','center']"
                                     data-width="['800','720','640','460']"
                                     data-height="none"
                                     data-whitespace="normal"
                                     data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                     data-responsive_offset="on"
                                     style="z-index: 5; white-space: nowrap;">
                                    <?= $slide->title ?>
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption tp-resizeme text-center text-white rs-parallaxlevel-0"
                                     id="slide-<?= $key ?>-layer-<?= $i + 1 ?>"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['top','top','top','top']" data-voffset="['275','260','220','220']"
                                     data-fontsize="['16','16',16',16']"
                                     data-lineheight="['24','24','24','24']"
                                     data-fontweight="['400','400','400','400']"
                                     data-textalign="['center','center','center','center']"
                                     data-width="['800','650','600','460']"
                                     data-height="none"
                                     data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                     data-responsive_offset="on"
                                     style="z-index: 5; white-space: nowrap;">
                                    <?= $slide->description ?>
                                </div>

                                <!-- LAYER NR. 4 -->
                                <div class="tp-caption rs-parallaxlevel-0"
                                     id="slide-<?= $key ?>-layer-<?= $i + 1 ?>"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['top','top','top','top']" data-voffset="['350','330','290','290']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                     data-responsive_offset="on"
                                     data-responsive="off"
                                     style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-theme-colored2 btn-lg btn-flat text-white font-weight-600 pl-30 pr-30 mr-15" href="#">Our Service</a><a class="btn btn-default btn-transparent btn-bordered btn-lg btn-flat font-weight-600 pl-30 pr-30" href="#">Get a Quote</a>
                                </div>

                            </li>

                        <?php } ?>

                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: rgba(255, 255, 255, 0.2);"></div>
                </div>
            </div>

        <?php } ?>
    </div>
</section>

<!-- Divider: Call To Action -->
<section class="bg-theme-colored2">
    <div class="container pt-0 pb-0">
        <div class="row">
            <div class="call-to-action sm-text-center pt-30 pb-20 pb-sm-30">
                <div class="col-md-9">
                    <h3 class="mt-5 text-white font-weight-600">Looking for a Talented Professional Business Plan Consultant?</h3>
                </div>
                <div class="col-md-3 text-right flip sm-text-center">
                    <a class="btn btn-theme-colored btn-lg font-weight-600 mt-5" href="#">Get a Quote<i class="fa fa-angle-double-right font-18 ml-10"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Features -->
<section id="features">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="feature-item maxwidth400 mt-30 mb-sm-30">
                        <div class="thumb">
                            <img src="/images/about/ab1.jpg" alt="" class="img-fullwidth">
                            <div class="title">
                                <a href="#"><h3> Global Market Business<i class="fa fa-globe pull-right"></i></h3></a>
                                <p>We deliver true results, focusing on strategic decisions and practical actions tailored to our clients We deliver true results, focusing on strategic decisions and practical actions tailored</p>
                                <a href="#" class="text-theme-colored2">Read More <span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="feature-item maxwidth400 mt-30 mb-sm-30">
                        <div class="thumb">
                            <img src="/images/about/ab3.jpg" alt="" class="img-fullwidth">
                            <div class="title">
                                <a href="#"><h3> Expert Team Leaders<i class="fa fa-pie-chart pull-right"></i></h3></a>
                                <p>We deliver true results, focusing on strategic decisions and practical actions tailored to our clients We deliver true results, focusing on strategic decisions and practical actions tailored</p>
                                <a href="#" class="text-theme-colored2">Read More <span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="feature-item maxwidth400 mt-30 mb-sm-30">
                        <div class="thumb">
                            <img src="/images/about/ab2.jpg" alt="" class="img-fullwidth">
                            <div class="title">
                                <a href="#"><h3> Marketing Planning<i class="fa fa-line-chart pull-right"></i></h3></a>
                                <p>We deliver true results, focusing on strategic decisions and practical actions tailored to our clients We deliver true results, focusing on strategic decisions and practical actions tailored</p>
                                <a href="#" class="text-theme-colored2">Read More <span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Services -->
<section id="services" class="services bg-silver-light">
    <div class="container pb-30">
        <div class="section-title text-center mb-40">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-uppercase title">ConsultingPro<span class="text-theme-colored2"> Services</span></h2>
                    <div class="diamond-line-centered-theme-colored2"></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-bar-chart-o font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Financial Analysis</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-area-chart font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Business Growth</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-pie-chart font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Success Report</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-cubes font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Marketing Plan</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-globe font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Global Business</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="icon-box iconbox-theme-colored text-center mb-40">
                        <a class="icon icon-bordered icon-rounded icon-border-effect effect-rounded mb-5" href="#">
                            <i class="fa fa-bug font-32"></i>
                        </a>
                        <h4 class="icon-box-title font-weight-600">Risk Management</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section About -->
<section>
    <div class="container pt-50">
        <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-uppercasetext-theme-colored mt-0">About <span class="text-theme-color-2">DUC</span></h2>
                    <div class="diamond-line-left-theme-colored-2"></div>
                    <p>
                        DUC International Consulting is an innovative consultancy skilled in providing expert advice, coaching and business services to companies of all sizes and Industry sectors considering expansion plans for emerging markets; Middle East, North Africa, Central Europe and China. The company has particular experience in the IT fast moving high technology sectors and innovative products and service areas.

                        Our aim is to enable our clients to expand operations and gain market presence, reducing risk and accelerating sales rapidly in national and international markets. The company has extensive experience and a strong network of contacts across the Middle East and North Africa and Central Europe.

                        <a class="text-theme-color-2 font-13 ml-5" href="#">read more →</a></p>
                </div>
                <div class="col-md-6">
                    <div class="box-hover-effect about-video mt-sm-30">
                        <div class="effect-wrapper">
                            <div class="thumb">
                                <img class="img-fullwidth" src="/images/video.png" alt="project">
                            </div>
                            <div class="video-button"></div>
                            <a class="hover-link" data-lightbox-gallery="youtube-video" href="https://youtu.be/kUbfZ6QRa_M" title="Youtube Video">Youtube Video</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($reviews !== null && count($reviews) > 0) { ?>

    <!-- Section: Client Say -->
    <section class="layer-overlay overlay-theme-colored-9 parallax" data-bg-img="/images/bg/bg7.jpg">
        <div class="container pt-90 pb-70">
            <div class="section-title text-center">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-uppercase text-white title">See What Our<span class="text-theme-colored2"> Client's Say</span></h2>
                        <div class="line-bottom-centered"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="owl-carousel-1col nav-testimonials" data-dots="true">

                        <?php foreach($reviews as $review) { ?>

                            <div class="item">
                                <div class="testimonial-wrapper text-center">
                                    <div class="content pt-10">
                                        <p class="font-17 text-white font-weight-300"><?= $review->review ?></p>
                                        <div class="thumb mt-30">
                                            <img class="img-circle img-thumbnail mb-15" alt="" src="<?= $review->logo ?>" style="width: 72px;" >
                                        </div>
                                        <h5 class="author text-white mt-0 mb-5"><?= $review->customer ?> - <span class="text-theme-colored2 font-14"><?= $review->designation ?></span></h5>
                                        <p class="text-gray-darkgray"><?= Yii::$app->formatter->asDate($review->created_at) ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


<?php } ?>

<?php if (count($members) > 0) { ?>

    <!-- Section: Team -->
    <section id="team">
        <div class="container pb-20">
            <div class="section-title text-center">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-uppercase title">Meet Our<span class="text-theme-colored2"> Team</span></h2>
                        <div class="diamond-line-centered-theme-colored2"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">

                    <?php foreach($members as $member) { ?>

                        <div class="col-sm-6 col-md-4">
                            <div class="single-member maxwidth400 mb-30">
                                <div class="team-thumb">
                                    <img src="<?= $member->pic ?>" alt="" class="img-fullwidth">
                                    <h4 class="text-uppercase font-raleway text-white font-16 line-bottom-center m-0"><?= $member->name ?> <span class="text-white font-12 ml-5">- <?= $member->designation ?></span></h4>
                                </div>
                                <div class="team-bottom-part bg-white p-15">
                                    <p class="mb-10"><?= substr($member->short_bio, 0, 150). '...' ?></p>
                                    <ul class="styled-icons icon-sm icon-dark icon-theme-colored2 icon-circled mt-15">

                                        <?php if($member->facebook) { ?>
                                            <li><a href="<?= $member->facebook ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php } ?>

                                        <?php if($member->linkedin) { ?>
                                            <li><a href="<?= $member->linkedin ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <?php } ?>

                                        <?php if($member->twitter) { ?>
                                            <li><a href="<?= $member->twitter ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php } ?>

                                        <?php if($member->youtube) { ?>
                                            <li><a href="<?= $member->youtube ?>"><i class="fa fa-youtube"></i></a></li>
                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>

<?php } ?>

<!-- Divider: Reservation Form -->
<section id="reservation" class="layer-overlay overlay-theme-colored-8 parallax" data-bg-img="/images/bg/bg7.jpg">
    <div class="container pt-sm-30 pb-sm-50">
        <div class="row">
            <div class="col-md-8">
                <div class="mt-10 mt-sm-40">
                    <!-- Reservation Form Start-->
                    <form id="reservation_form" name="reservation_form" class="reservation-form form-transparent" method="post" action="includes/reservation.php" novalidate>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-20">
                                    <input placeholder="Enter Name" id="reservation_name" name="reservation_name" required="" class="form-control" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-20">
                                    <input placeholder="Email" id="reservation_email" name="reservation_email" class="form-control" required="" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-20">
                                    <input placeholder="Phone" id="reservation_phone" name="reservation_phone" class="form-control" required="" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-20">
                                    <div class="styled-select">

                                        <select id="car_select" name="car_select" class="form-control" required aria-required="true">
                                            <option value="">- Select Your Categories -</option>
                                            <?php foreach($contacttypes as $type) { ?>
                                                <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                            <?php } ?>

                                        </select>
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <textarea class="form-control" name="message" placeholder="Discuss with us about consulting" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-0 mt-0">
                                    <input name="form_botcheck" class="form-control" value="" type="hidden">
                                    <button type="submit" class="btn btn-default btn-transparent btn-block pt-10 pb-10" data-loading-text="Please wait...">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Reservation Form End-->
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="text-white font-24 font-weight-600 mt-0 mt-sm-30">Request a Call Back </h3>
                <div class="diamond-line-left-theme-colored2"></div>
                <p class="lead text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis</p>
                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt adipisicing elit. Cum consectetur sit ullam perspiciatis, deserunt.</p>
                <img src="/images/signature-white.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- Section: blog -->
<section id="blog" style="display: none">
    <div class="container pb-40">
        <div class="section-title">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase title">Lates <span class="text-theme-colored2">News</span></h2>
                    <div class="diamond-line-left-theme-colored2"></div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <article class="post bg-lighter maxwidth400 mb-30">
                        <div class="entry-header">
                            <div class="post-thumb thumb">
                                <img src="/images/works/1.jpg" alt="" class="img-responsive img-fullwidth">
                            </div>
                        </div>
                        <div class="entry-content bg-white border-1px p-20">
                            <div class="entry-meta">
                                <ul class="list-inline font-12 mb-10">
                                    <li><i class="fa fa-user text-gray mr-5"></i>By: Author |</li>
                                    <li><i class="fa fa-calendar mr-5"></i> June 26, 2016 |</li>
                                    <li><i class="fa fa-comments-o mr-5"></i> 48</li>
                                </ul>
                            </div>
                            <h4 class="entry-title font-weight-600 text-uppercase mb-10"><a class="text-theme-colored" href="blog-single-left-sidebar.html">Konsulpro Business Meeting </a></h4>
                            <p class="mt-5">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis</p>
                            <a class="text-theme-colored font-weight-600 font-12" href="blog-single-left-sidebar.html"> View Details →</a>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-md-4">
                    <article class="post bg-lighter maxwidth400 mb-30">
                        <div class="entry-header">
                            <div class="post-thumb thumb">
                                <img src="/images/works/2.jpg" alt="" class="img-responsive img-fullwidth">
                            </div>
                        </div>
                        <div class="entry-content bg-white border-1px p-20">
                            <div class="entry-meta">
                                <ul class="list-inline font-12 mb-10">
                                    <li><i class="fa fa-user text-gray mr-5"></i>By: Author |</li>
                                    <li><i class="fa fa-calendar mr-5"></i> June 26, 2016 |</li>
                                    <li><i class="fa fa-comments-o mr-5"></i> 48</li>
                                </ul>
                            </div>
                            <h4 class="entry-title font-weight-600 text-uppercase mb-10"><a class="text-theme-colored" href="blog-single-left-sidebar.html">Konsulpro Business Meeting </a></h4>
                            <p class="mt-5">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis</p>
                            <a class="text-theme-colored font-weight-600 font-12" href="blog-single-left-sidebar.html"> View Details →</a>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-md-4">
                    <article class="post bg-lighter maxwidth400 mb-30">
                        <div class="entry-header">
                            <div class="post-thumb thumb">
                                <img src="/images/works/3.jpg" alt="" class="img-responsive img-fullwidth">
                            </div>
                        </div>
                        <div class="entry-content bg-white border-1px p-20">
                            <div class="entry-meta">
                                <ul class="list-inline font-12 mb-10">
                                    <li><i class="fa fa-user text-gray mr-5"></i>By: Author |</li>
                                    <li><i class="fa fa-calendar mr-5"></i> June 26, 2016 |</li>
                                    <li><i class="fa fa-comments-o mr-5"></i> 48</li>
                                </ul>
                            </div>
                            <h4 class="entry-title font-weight-600 text-uppercase mb-10"><a class="text-theme-colored" href="blog-single-left-sidebar.html">Konsulpro Business Meeting </a></h4>
                            <p class="mt-5">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis</p>
                            <a class="text-theme-colored font-weight-600 font-12" href="blog-single-left-sidebar.html"> View Details →</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
