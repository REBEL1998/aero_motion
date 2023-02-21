<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-md-12 col-xs-12">
		<?php if($this->session->flashdata('success')): ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('success'); ?>
		</div>
		<?php elseif($this->session->flashdata('error')): ?>
		<div class="alert alert-error alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('error'); ?>
		</div>
		<?php endif; 
		?>
		<!-- /.box -->
	</div>
	<!-- col-md-12 -->
</div>
<!-- /.row -->

<div class="row">
	<!-- customar project  start -->
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row align-items-center m-l-0">
					<div class="col-sm-6">
					</div>
					<div class="col-sm-6 text-right">
						<a href="<?php  if($this->uri->segment('4') != NULL) { echo base_url('admin/product/create/'.$this->uri->segment('4')); } else {echo base_url('admin/product/create');} ?>" class="btn btn-primary">Add <?php print $page_title; ?></a>
						<br /> <br />
					</div>
				</div>
				<div class="table-responsive">
					<table id="report-table" class="table table-bordered table-striped mb-0">
							<thead>
								<tr>
									<th width="20%">Image</th>
									<th width="20%">Name</th>
									<th width="20%">Category</th>
									<th width="20%">Title</th>
									<th width="8%" class="text-center" >Status</th>
									<th class="text-center" width="12%" >Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if($list_data){
								foreach ($list_data as $key => $value){ 
								$imageUrl = base_url('assets/admin/uploads/product/').$value['productImage'];
								?><tr>
										<td> <?php echo !empty($value['productImage']) ? '<img src="'.$imageUrl.'" width="100px" height="100px">' : 'NO Image Found'?></td>
										<td> <?php echo $value['prodName']; ?></td>
										<td> <?php echo $value['prodTitle']; ?></td>
										<td> <?php echo $value['catName']; ?></td>
										<td class="text-center">
											<?php $statusClass = $value['prodStatus'] == 'Y' ? "success" : "danger" ;?>
											<span class="tag badge badge-<?php echo $statusClass; ?>"><a href="<?php echo base_url('admin/product/status/'.$this->atri->en($value['prodId']).'/'.$this->uri->segment('4')) ?>" style="color:white;"><?php echo $arrStatus[$value['prodStatus']]; ?></a></span>
										</td>	
										<td class="text-center">
											<a href="<?php echo base_url('admin/product/edit/'.$this->atri->en($value['prodId']).'/'.$this->uri->segment('4')) ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
											<a href="#" onclick="cta_confirm('<?php echo base_url('admin/product/delete/'.$this->atri->en($value['prodId']).'/'.$this->uri->segment('4')) ?>','')" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
											<a href="<?php echo base_url('admin/product/attched/'.$this->atri->en($value['prodId']).'/'.$this->uri->segment('4')) ?>"  class="btn btn-success btn-sm"><i class="fas fa-file"></i>&nbsp;&nbsp;Attched Doc </a>
										</td>
									</tr>
								<?php }
								}else{ ?>
									<tr>
										<td colspan="6">No Product Found</td>
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
	<!-- customar project  end -->
	</div>
	
	<script>
		function cta_confirm(url = ''){
			
			var check = confirm("Are you sure you want delete product?");
			if (check == true) {
				window.location = url;
				return true;
			}
			else {
				return false;
			}
			
		}
	</script>