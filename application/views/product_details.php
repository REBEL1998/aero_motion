<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
.gallery-wrap .img-big-wrap img {
    height: 450px;
    width: 450px;
    display: inline-block;
    cursor: zoom-in;
	margin : 3px;
}


.gallery-wrap .img-small-wrap .item-gallery {
    width: 60px;
    height: 60px;
    border: 1px solid #ddd;
    margin: 7px 2px;
    display: inline-block;
    overflow: hidden;
}

.gallery-wrap .img-small-wrap {
    text-align: center;
}
.gallery-wrap .img-small-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 4px;
    cursor: zoom-in;
}
a:hover {
	text-decoration : none !important;
}
</style>
<div class="container" style="margin-bottom:20px">	
	<div class="card">
		<div class="row">
			<aside class="col-sm-5 border-right">
				<article class="gallery-wrap"> 
					<div class="img-big-wrap">
						<div class="mainImage"><img src="<?=!empty($arrProductDetails['productImage']) ? base_url(PRODUCTMAINIMAGEPATH).$arrProductDetails['productImage'] : 'https://i.imgur.com/9UYzfny.png' ?>"></div>
					</div> <!-- slider-product.// -->
					<div class="img-small-wrap">
						<?php foreach($arrAttchedDetails as $key => $value) { 
							if($value['typex'] == 'IMG'){?>
								<div class="item-gallery"> <img src="<?=base_url(PRODUCTMAINIMAGEPATH).$value['fileName']?>"> </div>	
						<?php } } ?>
					</div> <!-- slider-nav.// -->
				</article> <!-- gallery-wrap .end// -->
			</aside>
			<aside class="col-sm-7">
				<article class="card-body p-5">
					<h3 class="title mb-3"><?=$arrProductDetails['prodTitle']?></h3>
<?php /*
					<p class="price-detail-wrap"> 
						<span class="price h3 text-warning"> 
							<span class="currency">US $</span><span class="num">1299</span>
						</span> 
						<span>/per kg</span> 
					</p> <!-- price-detail-wrap .// -->
					*/?>
					<dl class="item-property">
						<dt>Description</dt>
						<dd><p><?=$arrProductDetails['prodDesc']; ?></p></dd>
					</dl>
					<?php
					 if(!empty($arrProductDetails['specification'])) {
						$arrSpecification = json_decode($arrProductDetails['specification'],true);
						foreach($arrSpecification as $key => $value){
						?>
							<dl class="item-property">
								<dt><?=$key?></dt>
								<dd><p><?=$value; ?></p></dd>
							</dl>
						<?php	}
					}	?>
					<?php /*<dl class="param param-feature">
						<dt>Model#</dt>
						<dd>12345611</dd>
					</dl>  <!-- item-property-hor .// -->
					<dl class="param param-feature">
						<dt>Color</dt>
						<dd>Black and white</dd>
					</dl>  <!-- item-property-hor .// -->
					<dl class="param param-feature">
						<dt>Delivery</dt>
						<dd>Russia, USA, and Europe</dd>
					</dl>  <!-- item-property-hor .// --> 
					
					<hr>
					<div class="row">
						<div class="col-sm-5">
							<dl class="param param-inline">
								<dt>Quantity: </dt>
								<dd>
									<select class="form-control form-control-sm" style="width:70px;">
										<option> 1 </option>
										<option> 2 </option>
										<option> 3 </option>
									</select>
								</dd>
							</dl>  <!-- item-property .// -->
						</div> <!-- col.// -->
						<div class="col-sm-7">
							<dl class="param param-inline">
								<dt>Size: </dt>
								<dd>
									<label class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
										<span class="form-check-label">SM</span>
									</label>
									<label class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
										<span class="form-check-label">MD</span>
									</label>
									<label class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
										<span class="form-check-label">XXL</span>
									</label>
								</dd>
							</dl>  <!-- item-property .// -->
						</div> <!-- col.// -->
					</div> <!-- row.// -->
					<hr>
					
					<a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
					<a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
					*/
					?>
				</article> <!-- card-body.// -->
			</aside> <!-- col.// -->
		</div> <!-- row.// -->
	</div> <!-- card.// -->


</div>
<!--container.//-->