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
				<div class="table-responsive">
					<table id="report-table" class="table table-bordered table-striped mb-0 ">
                        <thead>
                            <tr>
                                <th width="20%">Contact Name</th>
                                <th width="20%">Email</th>
                                <th width="20%">Phone</th>
                                <th width="20%" >Subject</th>
                                <th width="10%" class="text-center" data-orderable ="false" >Message</th>
                                <th width="10%" class="text-center" data-orderable ="false" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($list_data){?>
                            <?php 
                            foreach ($list_data as $k => $v){ 
                            ?><tr>
                                <td><?php echo $v['contactname']; ?></td>
                                <td><?php echo $v['email']; ?></td>
                                <td><?php echo $v['phone']; ?></td>
                                <td><?php echo $v['subject']; ?></td>
                                <td class="text-center">
                                    <div class="bootstrap-modal">
                                        <a data-target="#inquiryModal-<?php echo $v['id']; ?>"   data-toggle="modal" style="cursor: pointer;">
                                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-dot" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                            </svg>
                                        </a>
                                        <div class="modal fade" id="inquiryModal-<?php echo $v['id']; ?>" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Inquiry Message</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="inquiryMessage" style="text-align: left; white-space: pre-wrap; word-break: break-word;" >
                                                            <?php echo nl2br($v['message']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="cta_confirm('<?php echo base_url('admin/contactus/delete/'.$this->atri->en($v['id']).'/'.$this->uri->segment('4')) ?>','')" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
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
	<!-- customar project  end -->
</div>
