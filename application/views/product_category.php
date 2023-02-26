
<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200" style="padding:210px 0">
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
<div class=" container">
    <div class="row mt-5">
        <div class="col-12"><?php 

    foreach($arrProductData as $arrTempProduct) { 
        $arrTempSpecification = !empty($arrTempProduct['specification']) ? json_decode($arrTempProduct['specification'], true) : [];
        $arrDocuments = !empty($arrTempProduct['arrAttchements']['DOC']) ? $arrTempProduct['arrAttchements']['DOC'] : [];

        $arrTmp = [];
        $arrTmp[0]['fileName'] =  $arrTempProduct['productImage'];

        $arrImages = !empty($arrTempProduct['arrAttchements']['IMG']) ? $arrTempProduct['arrAttchements']['IMG'] : [];
        $arrImages = array_merge($arrTmp, $arrImages);

        ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <h3 class="mt-0"><?php print($arrTempProduct['prodName']); ?></h3>
                                <p class="mb-1"><?php print($arrTempProduct['prodDesc']); ?></p>
                            </div> 
                            <div class="col-lg-5 mt-5">
                                <div id="<?php echo "carousel-". $arrTempProduct['prodId']; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php 
                                            if (!empty($arrImages)) { 
                                                foreach($arrImages as $key => $arrTempImg) {
                                                    $active =  $key == 0 ? "active" : "";  
                                                    $tempId = "main-carousel-".$arrTempProduct['prodId']."-".$key;
                                                    ?><div class="carousel-item <?= $active; ?>" id="<?= $tempId ?>">
                                                            <?php if(!empty($arrTempImg['fileName'])){ ?>
                                                                <img  class="d-block w-100"  src="<?=base_url(PRODUCTMAINIMAGEPATH.$arrTempImg['fileName']);?>" alt="Product images">
                                                            <?php }?>
                                                        </div><?php 
                                                    }
                                            } 
                                        ?>
                                    </div>
                                    </br>
                                    <?php  
                                    if (!empty($arrImages) && count($arrImages) > 1) {  
                                        $tempId =   "carousel-". $arrTempProduct['prodId'];
                                        ?><ol class="carousel-indicators position-relative">
                                            <?php 
                                                foreach($arrImages as $key => $arrTempImg) {
                                                    $active =  $key == 0 ? "active" : "";  
                                                    $tempSubId = "sub-carousel-".$arrTempProduct['prodId']."-".$key;
                                                    ?><li data-target="<?php echo $tempId; ?>" data-slide-to="<?php echo $key;?>" class="sub-carousel-item w-25 h-auto <?= $active; ?>" id="<?php echo $tempSubId; ?>'" onclick="setSliderImage('<?php echo $arrTempProduct['prodId']; ?>', '<?php echo $key;?>')">
                                                            <?php if(!empty($arrTempImg['fileName'])){ ?>
                                                                <img  class="d-block w-50" src="<?=base_url(PRODUCTMAINIMAGEPATH.$arrTempImg['fileName']);?>" alt="Product images"> 
                                                            <?php }?>
                                                    </li><?php 
                                                }
                                            ?>
                                        </ol>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-lg-7 mt-5">
                                <div style="display:flex;" > 
                                <?php  if (!empty($arrDocuments)) { 
                                    ?><h5><span class="badge badge-success">Download Specification</span></h5><?php
                                    foreach($arrDocuments as $key => $arrTempDoc) {
                                        $strIndex= count($arrDocuments) > 1 ? "-" .$key + 1 : "";
                                        ?><div class="" style="padding-left:10px">
                                            <h5>
                                                <a href="<?=base_url(PRODUCTMAINIMAGEPATH.$arrTempDoc['fileName']);?>" download>
                                                    <span class="badge badge-outline-info">Document<?= $strIndex;?></span>
                                                </a>
                                            </h5>
                                        </div><?php 
                                    }
                                } ?>
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
                <!-- customar project  end -->
                <?php 
        } 
        ?>

        </div>  
    </div>
</div>