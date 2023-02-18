<!-- [ Layout sidenav ] Start -->
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
	<div class="app-brand demo">
		<span class="app-brand-logo demo">
			<img src="<?php echo base_url("assets/admin/img/logo.png"); ?>" alt="Brand Logo" class="img-fluid">
		</span>
		<a href="<?php echo base_url("admin/dashboard"); ?>" class="app-brand-text demo sidenav-text font-weight-normal ml-2">AERO Motion</a>
		<a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
			<i class="ion ion-md-menu align-middle"></i>
		</a>
	</div>
	<div class="sidenav-divider mt-0"></div>

	<!-- Links -->
	<ul class="sidenav-inner py-1">

		<!-- Dashboards -->
		<li class="sidenav-item open active">
			<ul class="sidenav-menu">
				<li class="sidenav-item active">
					<a href="<?php echo base_url("admin/category"); ?>" class="sidenav-link">
						<div>Category</div>
					</a>
				</li>
				<li class="sidenav-item">
					<a href="<?php echo base_url("admin/product"); ?>" class="sidenav-link">
						<div>Products</div>
					</a>
				</li>
				<li class="sidenav-item">
					<a href="<?php echo base_url("admin/contact_us"); ?>" class="sidenav-link">
						<div>Contact Us</div>
					</a>
				</li>
				<li class="sidenav-item">
					<a href="<?php echo base_url("admin/system_setting"); ?>" class="sidenav-link">
						<div>System Settings</div>
					</a>
				</li>
			</ul>
		</li>
	</ul>
</div>