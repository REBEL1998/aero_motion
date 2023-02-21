            
                
                    <!-- [ Layout footer ] Start 
                    <nav class="layout-footer footer footer-light">
                        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                            
                            <div>
                                <a href="javascript:" class="footer-link pt-3">About Us</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </nav> 
                    [ Layout footer ] End -->

                    </div>
                    <!-- [ content ] End -->
                </div>
                <!-- [ Layout content ] Start -->
            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper] End -->
    
    
    <!-- Core scripts -->
    <script src="<?php echo base_url("assets/admin/js/pace.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/jquery-3.3.1.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/popper/popper.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/bootstrap.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/sidenav.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/layout-helpers.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/material-ripple.js") ?>"></script>

    <!-- Libs -->
    <script src="<?php echo base_url("assets/admin/libs/perfect-scrollbar/perfect-scrollbar.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/eve/eve.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/flot/flot.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/flot/curvedLines.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/chart-am4/core.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/chart-am4/charts.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/chart-am4/animated.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/libs/dropzone/dropzone.js") ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/pages/forms_file-upload.js") ?>"></script>

    <!-- Demo -->
    <script src="<?php echo base_url("assets/admin/js/demo.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/common.js") ?>"></script>
  

<?php if(isset($js)){	
	if (file_exists($js)) {
           include $js;
        }else{
		echo "<!--page $js file load fail Error 404-->";
		}
 }?>

</body>
</html>
