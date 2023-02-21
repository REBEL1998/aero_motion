<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                         <h2><?php echo $arrMainCategory['name'];?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php foreach($arrProductData as $arrTempProduct) { 
    
    $arrTempSpecification = !empty($arrTempProduct['specification']) ? json_decode($arrTempProduct['specification'], true) : [];
    
    ?>
    <section class="w3l-features-photo-7">
        <div class="features-photo-7_sur">
            <div class="wrapper">
                <div class="features-photo-7_top mt-5">
                        <div class="features-photo-7_top-right">
                                <div class="galleryContainer"> 
                                    <div class="gallery">
                                        <?php if(!empty($arrTempProduct['productImage'])){ ?>
                                            <img class=""  src="<?=base_url('assets/admin/uploads/product/'.$arrTempProduct['productImage']);?>" width="500px" heigth="500px">
                                        <?php }
                                        else {
                                            ?><img class="galleryImage" src="<?=base_url('assets/images/pr-1.jpg');?>" alt=""><?php
                                        } ?>
                                    </div>
                                    <div class="thumbnails"> </div>
                            </div>
                        </div>
                        <div class="features-photo-7_top-left">
                            <h2><?php print($arrTempProduct['prodName']); ?></h2>
                            </br>
                            <p><?php print($arrTempProduct['prodDesc']); ?></p>	
                            <div class="color-quality-right">
                            </div>
                            <div class="desc_single">
                                <h6>Key Features</h6>
                                <?php if ( !empty($arrTempSpecification) ) {?>
                                    <table class="table table-striped">
                                        <tbody>
                                        <?php foreach($arrTempSpecification as $key => $val) {?>
                                            <tr scope="row">
                                                <td><?php print($key); ?></td>
                                                <td><?php print($val); ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>