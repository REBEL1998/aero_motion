<footer class="footer-area ">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-3 col-xl-4">
                        <div class="single-footer-widget footer_1">
                            <a href="index.html"> <img src="<?php echo base_url("assets/front-end/img/footer-logo.png"); ?>" alt="" style="width:300px;"> </a>
                            <p>Waters make fish every without firmament saw had. Morning air subdue very one. Whales grass
                                is fish whales winged.
                            </p>
                            <div class="social-links">
                                <ul>
                                    <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                    <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
                                    <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xl-3">
                        <div class="single-footer-widget">
                            <h4>Products</h4>
                            <ul>
                                <?php if ( !empty($arrCategoryData) ){ ?>
                                 <?php foreach($arrCategoryData as $arrTempData){ ?>
                                    <li><a href="<?php echo base_url("category/".$arrTempData['url_key']); ?>"><?php echo $arrTempData['name']; ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xl-3">
                        <div class="single-footer-widget footer_icon">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="copyright_part_text text-center">
                            <p class="footer-text m-0">
                                Copyright &copy;<script data-cfasync="false"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="<?php echo base_url();?>" target="_blank">Aero Motion</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript">
            var currentURI = '<?php print $this->uri->uri_string(); ?>';
            var baseURI = '<?php print base_url(); ?>';
            var calledURI = baseURI + currentURI;
        </script>
        <script src="<?php echo base_url("assets/front-end/js/vendor/jquery-1.12.4.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/popper.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/bootstrap.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/owl.carousel.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/isotope.pkgd.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/ajax-form.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/waypoints.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.counterup.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/imagesloaded.pkgd.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/scrollIt.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.scrollUp.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/wow.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/nice-select.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.slicknav.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.magnific-popup.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/plugins.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/contact.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.ajaxchimp.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.form.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/jquery.validate.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/mail-script.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/main.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/contact-us.js"); ?>"></script>
        <script src="<?php echo base_url("assets/front-end/js/sweetalert.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/common.js"); ?>"></script>

        <?php

        if(!empty($arrJs)){
            foreach($arrJs as $footer_js_file){
                echo '<script src="'.$footer_js_file.'"></script>';
            }    
        }
        
        ?>
    </body>
</html>