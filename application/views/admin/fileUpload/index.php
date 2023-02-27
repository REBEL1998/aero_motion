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
<h6 class="card-header">Upload Document</h6>	
<div class="card-body">
	<form action="<?= base_url('admin/product/attched?propertyId='.$this->atri->en($prodId)) ?>" class="dropzone needsclick" id="dropzone-demo" enctype="multipart/form-data">
		<div class="dz-message needsclick">
			Drop files here or click to upload
			<span class="note needsclick">(This is just a demo dropzone. Selected files are<strong>not</strong> actually uploaded.)</span>
		</div>
		<div class="fallback">
			<input type="file" data-required="Y"  name="uploadDoc[]" multiple>
			<input type="hidden" name="propertyId" data-required="Y" value="<?=$this->atri->en($prodId)?>">
			<div class="clearfix"></div>
		</div>
	</form>
	<div class="form-group row">
		<div class="col-sm-12 ml-sm-auto mt-3">
			<a href="<?= base_url('admin/product/attched/').$this->atri->en($prodId);?>" class="btn btn-primary">Upload</a>
			<a href="<?= base_url('admin/product');?>" class="btn btn-warning">back</a>
		</div>
	</div>
</div>
</div>
<!-- customar project  start -->
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="product-table" class="table table-bordered table-striped mb-0">
							<thead>
								<tr>
									<th>Document</th>
									<th class="text-center" width="12%" >Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if($list_data){
								foreach ($list_data as $key => $value){ 
								$imageUrl = base_url().PRODUCTMAINIMAGEPATH.$value['fileName'];
								?><tr>
										<td> <?php echo !empty($value['fileName']) && $value['typex'] == 'IMG' ? '<img src="'.str_replace(" ","_",$imageUrl).'" width="100px" height="100px">' : '<a href="'.$imageUrl.'" target="_blank">Click to view</a>'?></td>
		
										<td class="text-center">
											<a href="#" onclick="cta_confirm('<?php echo base_url('admin/product/deleteAttchedImage/'.$this->atri->en($value['recId']).'/'.$this->uri->segment('4')) ?>','')" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
										</td>
									</tr>
								<?php }
								}else{ ?>
									<tr>
										<td colspan="6">No Attchement Found</td>
									</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>