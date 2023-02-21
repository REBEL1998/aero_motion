<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>AERO Motion</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("assets/front-end/img/favicon.png"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/owl.carousel.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/magnific-popup.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/themify-icons.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/nice-select.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/flaticon.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/animate.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/slicknav.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/style.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/front-end/css/sweetalert.css"); ?>">
    </head>
    <body>
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area white-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url("assets/front-end/img/logo.png"); ?>" alt="" style="width: 170px;">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="main-menu d-none d-lg-block " style="text-align:right">
                                <nav>
                                    <ul id="navigation"><?php 
                                        
                                        $arrNavbar = [
                                            0 => [
                                                "title" => "Home",
                                                "url" => base_url(""),
                                                "urlKey" => "",
                                            ],
                                            1 => [
                                                "title" => "Company Profile",
                                                "url" => base_url("company_profile"),
                                                "urlKey" => "company_profile",
                                            ],
                                            2 => [
                                                "title" => "Products",
                                                "url" => base_url("products"),
                                                "urlKey" => "products",
                                            ],
                                            3 => [
                                                "title" => "Contact",
                                                "url" => base_url("contact-us"),
                                                "urlKey" => "contact-us",
                                            ],
                                        ];  
                                        
                                        foreach($arrNavbar as $key => $arrTempNavbar) {
                                            $strActive = $this->uri->segment(1) == 	$arrTempNavbar['urlKey'] ? "active" : ""; 					
                                            ?><li><a class="<?php print($strActive); ?>" href="<?php echo $arrTempNavbar['url']; ?>"><?php echo $arrTempNavbar['title']; ?></a></li><?php
                                         }
                                        ?></ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>