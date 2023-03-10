<?php 

/*
<style> 
.mydiv{margin-top: 50px;margin-bottom: 50px}.cross{font-size:10px}.padding-0{padding-right: 5px;padding-left: 5px}.img-style{margin-left: -11px;box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);border-radius: 5px;max-width: 104% !important}.m-t-20{margin-top: 20px}.bbb_background{background-color: #E0E0E0 !important}.ribbon{width: 150px;height: 150px;overflow: hidden;position: absolute}.ribbon span{position: absolute;display: block;width: 34px;border-radius: 50%;padding: 8px 0;background-color: #3498db;box-shadow: 0 5px 10px rgba(0, 0, 0, .1);color: #fff;font: 100 18px/1 'Lato', sans-serif;text-shadow: 0 1px 1px rgba(0, 0, 0, .2);text-transform: uppercase;text-align: center}.ribbon-top-right{top: -10px;right: -10px}.ribbon-top-right::before, .ribbon-top-right::after{border-top-color: transparent;border-right-color: transparent}.ribbon-top-right::before{top: 0;left: 17px}.ribbon-top-right::after{bottom: 17px;right: 0}.sold_stars i{color: orange}.ribbon-top-right span{right: 17px;top: 17px}div{display: block;position: relative;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box}.bbb_deals_featured{width: 100%}.bbb_deals{width: 100%;margin-right: 7%;padding-top: 80px;padding-left: 25px;padding-right: 25px;padding-bottom: 34px;box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);border-radius: 5px;margin-top: 0px}.bbb_deals_title{position: absolute;top: 10px;left: 22px;font-size: 18px;font-weight: 500;color: #000000}.bbb_deals_slider_container{width: 100%}.bbb_deals_item{width: 100% !important}.bbb_deals_image{width: 100%}.bbb_deals_image img{width: 100%}.bbb_deals_content{margin-top: 33px}.bbb_deals_item_category a{font-size: 14px;font-weight: 400;color: rgba(0, 0, 0, 0.5)}.bbb_deals_item_price_a{font-size: 14px;font-weight: 400;color: rgba(0, 0, 0, 0.6)}.bbb_deals_item_price_a strike{color: red}.bbb_deals_item_name{font-size: 24px;font-weight: 400;color: #000000}.bbb_deals_item_price{font-size: 24px;font-weight: 500;color: #6d6e73}.available{margin-top: 19px}.available_title{font-size: 16px;color: rgba(0, 0, 0, 0.5);font-weight: 400}.available_title span{font-weight: 700}@media only screen and (max-width: 991px){.bbb_deals{width: 100%;margin-right: 0px}}@media only screen and (max-width: 575px){.bbb_deals{padding-left: 15px;padding-right: 15px}.bbb_deals_title{left: 15px;font-size: 16px}.bbb_deals_slider_nav_container{right: 5px}.bbb_deals_item_name, .bbb_deals_item_price{font-size: 20px}}
</style>
<div class="container mydiv">
    <div class="row">
	 <?php foreach($arrProductData as $key => $value) { ?>
	   <a href="<?=base_url('productDetails/').$value['prodId']?>">
        <div class="col-md-4" style="margin-bottom:20px">
            <!-- bbb_deals -->
            <div class="bbb_deals">
                <div class="bbb_deals_title"><?=$value['prodTitle']?></div>
                <div class="bbb_deals_slider_container">
                    <div class=" bbb_deals_item">
                        <div class="bbb_deals_image">
							<img src="<?= !empty($value['productImage']) ? base_url(PRODUCTMAINIMAGEPATH).$value['productImage'] : 'https://i.imgur.com/9UYzfny.png' ?>" alt="" height="150px">
						</div>
                        <div class="bbb_deals_content">
                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                <div class="bbb_deals_item_category"><a href="#"><?=$value['prodDesc']; ?></a></div>
                                <?php //<div class="bbb_deals_item_price_a ml-auto"><strike>???30,000</strike></div>?>
                            </div>
                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                <div class="bbb_deals_item_name"><?=$value['catName']; ?></div>
                               <?php // <div class="bbb_deals_item_price ml-auto">???25,550</div> ?>
                            </div>?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</a>
	 <?php } ?>
    </div>
</div>
*/
?>
<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                         <h2>Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <?php foreach($arrCategoryData as $arrTempData){ ?>
        <div class="col-xl-4 col-md-4" style="margin: 25px 0">
            <div class="single-service">
                <a href="<?php echo base_url("category/".$arrTempData['url_key']); ?>" >
                    <div class="service-thumb">
                        <img src="<?php echo base_url("assets/uploads/category/".$arrTempData['imagename']);?>" alt="" style="height: 300px; width: 100%; object-fit: contain;">
                    </div>
                    <h3 class="text-center" style="margin: 5px 0"><?php echo $arrTempData['name'];?></h3>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>