<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<section>
	<div class="row mb-2">
	  <div class="col-sm-12 mt-20 text-center">
		<h1>404 Error Page</h1>
	  </div>
	</div>
</section>

    <!-- Main content -->
<section class="content text-center mt-20 mb-20">
  <div class="error-page">
	<h2 class="headline text-warning"> 404</h2>

	<div class="error-content">
	  <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

	  <p>
		We could not find the page you were looking for.
		Meanwhile, you may <a href="<?php print base_url("admin") ?>">return to Home</a>.
	  </p>
	</div>
	<!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>