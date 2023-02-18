<!-- Main content -->
<section class="content">
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
		
	
		<a href="<?php  if($this->uri->segment('4') != NULL) { echo base_url('admin/category/create/'.$this->uri->segment('4')); } else {echo base_url('admin/category/create');} ?>" class="btn btn-primary">Add <?php print $page_title; ?></a>
		<br /> <br />
		
		<!-- /.box -->
	</div>
	<!-- col-md-12 -->
	</div>
	<!-- /.row -->

<div class="row">
	<div class="col-xl-12 col-md-12">
		<div class="card mb-4">
			<h5 class="card-header">Category Listing</h5>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
						<th width="">Name</th>
						<th width="">Industry Name</th>
						<th width="">Short Description</th>
						<th width="20%" class="text-center" >Status</th>
						<th width="20%" class="text-center" data-orderable ="false">Image</th>
						<th width="15%" class="text-center" data-orderable ="false">Action</th>
							<th class="text-right">Action</th>
						</tr>
					</thead>

					<tbody>
					<?php if($list_data){?>
						<?php 
						foreach ($list_data as $k => $v){ 
						
						$imgPath = base_url('assets/');
						
						if($v['imagename'] != null){
							$categoryImagePath = $imgPath.'sysimagedocs/'.$v['imagename'];
						}
						else{
							$categoryImagePath = $imgPath.'sysimagedocs/no_image.png';
						}

						?><tr>
								<td><?php if($v['level'] == 1) { ?><a href = "<?php echo base_url('admin/category/index/'.$this->atri->en($v['id']));  ?>" > <?php } echo $v['name']; ?><?php  if($v['level'] == 1) { ?></a><?php } ?></td>
								<td><?php echo $v['industry']; ?></td>
								<td><?php echo $v['description']; ?></td>
								<td class="text-center"><a href="<?php echo base_url('admin/category/status/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>" class=""><?php echo $arrStatus[$v['status']]; ?></a></td>
								<td class="text-center img-fluid ui-w-40" ><img src=<?php echo $categoryImagePath; ?> height='100px' width='100px'></td>
								<td class="text-center">
									<a href="j<?php echo base_url('admin/category/edit/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>"><i class="lnr lnr-pencil mr-2"></i></a>
									<a href="#" onclick="cta_confirm('<?php echo base_url('admin/category/delete/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>','')"><i class="lnr lnr-trash text-danger"></i></a>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Data card 2 End -->

	<!-- [ Data widgets ] End -->
</div>



<div class="row">
	<!-- customar project  start -->
	<div class="col-xl-12">F
		<div class="card">
			<div class="card-body">
				<div class="row align-items-center m-l-0">
					<div class="col-sm-6">
					</div>
					<div class="col-sm-6 text-right">
						<button class="btn btn-success btn-sm mb-3 btn-round" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Add Doctor</button>
					</div>
				</div>
				<div class="table-responsive">
					<div id="report-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="report-table_length"><label>Show <select name="report-table_length" aria-controls="report-table" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="report-table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="report-table"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="report-table" class="table table-bordered table-striped mb-0 dataTable no-footer" role="grid" aria-describedby="report-table_info">
							<thead>
								<tr>
									<th width="">Name</th>
									<th width="">Industry Name</th>
									<th width="">Short Description</th>
									<th width="20%" class="text-center" >Status</th>
									<th width="20%" class="text-center" data-orderable ="false">Image</th>
									<th width="15%" class="text-center" data-orderable ="false">Action</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if($list_data){?>
								<?php 
								foreach ($list_data as $k => $v){ 
								
								$imgPath = base_url('assets/');
								
								if($v['imagename'] != null){
									$categoryImagePath = $imgPath.'sysimagedocs/'.$v['imagename'];
								}
								else{
									$categoryImagePath = $imgPath.'sysimagedocs/no_image.png';
								}
								?><tr>
										<td><?php if($v['level'] == 1) { ?><a href = "<?php echo base_url('admin/category/index/'.$this->atri->en($v['id']));  ?>" > <?php } echo $v['name']; ?><?php  if($v['level'] == 1) { ?></a><?php } ?></td>
										<td><?php echo $v['industry']; ?></td>
										<td><?php echo $v['description']; ?></td>
										<td class="text-center"><a href="<?php echo base_url('admin/category/status/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>" class=""><?php echo $arrStatus[$v['status']]; ?></a></td>
										<td class="text-center img-fluid ui-w-40" ><img src=<?php echo $categoryImagePath; ?> height='100px' width='100px'></td>
										<td class="text-center">
											<a href="<?php echo base_url('admin/category/edit/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
											<a href="#" onclick="cta_confirm('<?php echo base_url('admin/category/delete/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>','')" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
										</td>
									</tr>
								<?php } ?>
							<?php } ?>
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