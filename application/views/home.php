<div class="slider-area">
    <div class="slider-active owl-carousel" style="">
        <div class="single-slider bg-img-1">
        </div>
        <div class="single-slider bg-img-2">
        </div>
        <div class="single-slider bg-img-3">
        </div>
    </div>
</div>


<?php 
// company inrtoductions
$this->load->view('templates/company-introduction',[]);
?>

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
                                <img src="<?=base_url(PRODUCTMAINIMAGEPATH.$arrTempProduct['productImage']);?>" alt="" style="width:350px;height:350px">
                            </div>
                            <div class="project-info">
                                <span style="color:white;"><?php echo $arrTempProduct['catName']; ?></span>
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