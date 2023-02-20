<!-- [ Layout sidenav ] Start -->
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-white">
	<div class="app-brand demo">
		<span class="app-brand-logo demo">
			<img src="<?php echo base_url("assets/admin/img/logo-dark.png"); ?>" alt="Brand Logo" class="img-fluid" style="width:40px;">
		</span>
		<a href="<?php echo base_url("admin/dashboard"); ?>" class="app-brand-text demo sidenav-text font-weight-normal ml-2"><b>AERO Motion</b></a>
		<a href="javascript:" class="sidenav-link text-large ml-auto">
			<i class="ion ion-md-menu align-middle"></i>
		</a>
	</div>
	<div class="sidenav-divider mt-0"></div>
	<!-- Links -->
	<ul class="sidenav-inner py-1"><?php 
		
		$arrSiderbar = [
			0 => [
				"title" => "Dashboard",
				"url" => base_url("admin/dashboard"),
				"urlKey" => "dashboard",
			],
			1 => [
				"title" => "Category",
				"url" => base_url("admin/category"),
				"urlKey" => "category",
			],
			2 => [
				"title" => "Product",
				"url" => base_url("admin/product"),
				"urlKey" => "product",
			],
			3 => [
				"title" => "Contact Us",
				"url" => base_url("admin/contactus"),
				"urlKey" => "contactus",
			],
			4 => [
				"title" => "System Settings",
				"url" => base_url("admin/system_setting"),
				"urlKey" => "system_setting",
			],
		];
		
		?><!-- Dashboards -->
		<li class="sidenav-item open active">
			<ul class="sidenav-menu">
				<?php 
				foreach($arrSiderbar as $key => $arrTempSidebar) {
					$strActive = $this->uri->segment(2) == 	$arrTempSidebar['urlKey'] ? "active" : ""; 					
					?><li class="sidenav-item <?php print($strActive); ?>">
						<a href="<?php echo $arrTempSidebar['url']; ?>" class="sidenav-link">
							<div><?php echo $arrTempSidebar['title']; ?></div>
						</a>
					</li><?php
				}
			?></ul>
		</li>
	</ul>
</div>