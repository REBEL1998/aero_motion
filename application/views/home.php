<div class="slider-area">
    <div class="slider-active owl-carousel">
        <div class="single-slider bg-img-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 offset-xl-1 col-lg-7">
                        <div class="slider-content">
                            <p>Quality work. Trustable service. Dedicated team</p>
                            <h3>We provide your Industrial solution</h3>
                            <div class="slider-btn">
                                <a class="boxed-btn2" href="#">Our Services <i class="Flaticon flaticon-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-slider bg-img-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 offset-xl-1 col-lg-7">
                        <div class="slider-content">
                            <p>Quality work. Trustable service. Dedicated team</p>
                            <h3>We provide your Industrial solution</h3>
                            <div class="slider-btn">
                                <a class="boxed-btn2" href="#">Our Services <i class="Flaticon flaticon-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-slider bg-img-1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 offset-xl-1 col-lg-7">
                        <div class="slider-content">
                            <p>Quality work. Trustable service. Dedicated team</p>
                            <h3>We provide your Industrial solution</h3>
                            <div class="slider-btn">
                                <a class="boxed-btn2" href="#">Our Services <i class="Flaticon flaticon-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="brand-area gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="brand-active owl-carousel">
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/1.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/2.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/3.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/4.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/5.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/6.png"); ?>" alt="">
                    </div>
                    <div class="single-brand">
                        <img src="<?php echo base_url("assets/front-end/img/brand/4.png"); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="service-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="section-title text-center mb-65">
                <span>OUR SERVICES</span>
                <h3>We provide all of your <br>
                    industrial solution
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-4">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="<?php echo base_url("assets/front-end/img/service/1.jpg"); ?>" alt="">
                    </div>
                    <h3>Industrial construction</h3>
                    <p>Waters make fish every without firmament saw had. Morning air subdue.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="<?php echo base_url("assets/front-end/img/service/2.jpg"); ?>" alt="">
                    </div>
                    <h3>Mechanical engineering</h3>
                    <p>Waters make fish every without firmament saw had. Morning air subdue.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="single-service">
                    <div class="service-thumb">
                        <img src="<?php echo base_url("assets/front-end/img/service/1.jpg"); ?>" alt="">
                    </div>
                    <h3>Bridge construction</h3>
                    <p>Waters make fish every without firmament saw had. Morning air subdue.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="project-area bg-img-2 overlay">
    <div class="container-fluid p-lg-0">
        <div class="row justify-content-end no-gutters">
            <div class="col-xl-4 col-md-6">
                <div class="section-title text-white mb-65 ml-80">
                    <h3>Take a look around <br>
                        our products
                    </h3>
                    <p>Waters make fish every without firmament saw had. <br> Morning air subdue.</p>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="project-active owl-carousel">
                    <?php foreach($arrProductData as $arrTempProduct) { ?>
                        <div class="single-project">
                            <div class="project-thumb">
                                <img src="<?=base_url('assets/admin/uploads/product/'.$arrTempProduct['productImage']);?>" alt="" style="width:350px;height:350px">
                            </div>
                            <div class="project-info">
                                <span><?php echo $arrTempProduct['catName']; ?></span>
                                <h3><?php echo $arrTempProduct['prodName']; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cta-area cta-bg-1">
    <div class="container">
        <div class="col-xl-6 col-lg-7">
            <div class="cta-content">
                <h3>Let’s talk about your <br>
                    industrial problems
                </h3>
                <p>Waters make fish every without firmament saw had. <br> Morning air subdue very one. Whales grass
                    is
                    fish <br> whales winged.
                </p>
                <div class="cta-btn">
                    <a class="boxed-btn2 black-bg" href="<?php echo base_url('contact-us'); ?>">Discuss now <i class="Flaticon flaticon-right-arrow"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>