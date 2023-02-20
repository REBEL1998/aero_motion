<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12 col-xs-12">
        <?php if($this->session->flashdata('errors') && !empty(validation_errors())){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
        </div>
        <?php } ?>
        <?php ?>
    </div>  
</div>
  <div class="card mb-4">
        <h6 class="card-header"><?= isset($doAction) && $doAction == 'Edit' ? 'Edit' : 'Add'?> Product</h6>
        <div class="card-body">
            <form role="form" id="frmLevel0" name="frmLevel0" action="<?php base_url('admin/product/create') ?>" method="post" onsubmit="return submitForm('#frmLevel0');" enctype="multipart/form-data">
                <div class="form-group row">
					<label class="col-form-label col-sm-2 text-sm-right">Select Category<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                       <select class="form-control" name="catId" id="catId">
						<?php 
							foreach($arrCategory as $catId => $catValue){
								$selectedId = $selectedCatId ==  $catValue['id']  ? 'selected' : '';
							?>
								<option value="<?=$catValue['id']?>" <?=$selectedId?>><?=$catValue['name']?></option>
							<?php
							}
						?>
						</select>
                        <div class="clearfix"></div>
                    </div>
				</div>
				
				<div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Product Name<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control validate-control" value="<?php print $txtName; ?>" data-required="Y" id="txtName" name="txtName" autocomplete="off">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Product Title</label>
                    <div class="col-sm-10">
                        <textarea  rows="4" cols="50" class="form-control validate-control"  data-required="Y" id="txtTitle" name="txtTitle" autocomplete="off"><?php print $txtTitle; ?> </textarea>
                    </div>
                </div>
				 <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Product Short description</label>
                    <div class="col-sm-10">
                        <textarea  rows="4" cols="50" class="form-control validate-control"  data-required="Y" id="txtShortDesc" name="txtShortDesc" autocomplete="off"><?php print $txtShortDesc; ?> </textarea>
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-form-label col-sm-2 text-sm-right">Main Image</label>
					<div class="col-sm-10">
						<?php if(!empty($productImage)){ ?>
							<img src="<?=base_url().'assets/admin/uploads/product/'.$productImage?>"width="100px" height = "100px">
							<a href="<?=base_url('admin/product/')?>deleteimage/<?=$this->atri->en($prodId)?>" class="btn btn-secondary" >Delete</a>
						<?php } else{ ?>
							<input type="file" name="productImage">
						<?php } ?>
					</div>
				</div>
				<div class="addContact">
					<?php 
					
					if(isset($doAction) && $doAction == 'Edit'){
							$arrSpecification = json_decode($jsonSpecification,true); 
							$count = 1;
						  foreach($arrSpecification as $key => $value){
						?>
							<div class="form-group row contact_incress">
								<label class="col-form-label col-sm-2 text-sm-right">Add Specification <?=$count?></label>
								<div class="col-sm-4">
									<input type="text" class="form-control validate-control" value="<?=$key?>" data-required="Y"  name="txtSpecificationName[]" autocomplete="off">
								</div>
								<div class="col-sm-4">
									<input type="text" class="form-control validate-control" value="<?=$value?>" data-required="Y" name="txtSpecificationValue[]" autocomplete="off">
								</div>
								<div class="col-sm-1">
									
									<?php echo $count == 1 ? '<a class="btn btn-secondary" onClick="addspecification()"><i class="fas fa-plus"></i></a>' :
									'<a class="btn btn-secondary" id="remove"><i class="fas fa-minus"></i></a>'; ?>
								</div>
							</div>
						  
						  <?php
						  $count++;
						  }
					}else{
					?>
					<div class="form-group row contact_incress">
						<label class="col-form-label col-sm-2 text-sm-right">Add Specification</label>
						<div class="col-sm-4">
							<input type="text" class="form-control validate-control" value="" data-required="Y"  name="txtSpecificationName[]" autocomplete="off">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control validate-control" value="" data-required="Y" name="txtSpecificationValue[]" autocomplete="off">
						</div>
						<div class="col-sm-1">
							<a class="btn btn-secondary" onClick="addspecification()"><i class="fas fa-plus"></i></a>
						</div>
					</div>
					<?php } ?>
				</div>
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url('admin/product/') ?>" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
	
	<script>
			
			
			function addspecification(){
				var count  = $('.contact_incress').length + 1;
				var html = '<div class="form-group row contact_incress">';
				html+='<label class="col-form-label col-sm-2 text-sm-right">Add Specification '+count+'</label>';
				html+='<div class="col-sm-4">';
				html+='<input type="text" class="form-control validate-control" value="" data-required="Y" name="txtSpecificationName[]" autocomplete="off">';
				html+='</div>';
				html+='<div class="col-sm-4">';
				html+='<input type="text" class="form-control validate-control" value="" data-required="Y" name="txtSpecificationValue[]" autocomplete="off">';
				html+='</div>';
				html+='<div class="col-sm-1">';
				html+='<a class="btn btn-secondary" id="remove"><i class="fas fa-minus"></i></a>';
				html+='</div>';
				html+= '</div>';
				
				$('.addContact').append(html);
			}
			
			$('.addContact').on('click','#remove',function(){
				$(this).closest('.contact_incress').remove();
			});
	
	</script>