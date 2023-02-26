
<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed"><head>
    <title>Aero Motion | Admin</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/admin/img/favicon.png"); ?>">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/fontawesome.css") ;?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/ionicons.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/linearicons.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/open-iconic.css") ;?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/pe-icon-7-stroke.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/fonts/feather.css") ;?>">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/css/bootstrap-material.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/css/shreerang-material.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/css/uikit.css") ;?>">

    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url("assets/admin/css/pages/authentication.css"); ?>">
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Content ] Start -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style='background-image: url("<?php echo base_url('assets/admin/img/bg/23.jpg'); ?>")'>
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">
            <div class="card">
                <div class="p-4 p-sm-5">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-60">
                            <div class="w-100 position-relative">
                                <img src="<?php echo base_url("assets/admin/img/logo-dark.png"); ?>" alt="Brand Logo" class="img-fluid">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- [ Logo ] End -->

                    <h5 class="text-center text-muted font-weight-normal mb-4">Sign Up Account</h5>

                    
                    <?php echo validation_errors('<div class="alert alert-danger" role="alert">','</div>'); ?> 

                    <?php if(!empty($errors)) {
                        echo $errors;
                    } ?>

                    <!-- Form -->
                    <form action="<?php echo base_url('admin/auth/create_admin_user') ?>" method="post" >
                        <div class="form-group">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="User Name" autocomplete="off" required>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="First Name" autocomplete="off" value="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="txtLastName" id="txtLastName" placeholder="Last Name" autocomplete="off"  value="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" autocomplete="off" required>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label d-flex justify-content-between align-items-end">
                                <span>Password</span>
                            </label>
                            <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Password" autocomplete="off" required>
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-0">
                            <button type="submit" class="btn btn-primary align-items-center">Sign In</button>
                        </div>
                    </form>
                    <!-- [ Form ] End -->
                </div>
            </div>

        </div>
    </div>
    <!-- / Content -->

    <!-- Core scripts -->
    <script src="<?php echo base_url("assets/admin/js/jquery-3.3.1.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/bootstrap.js"); ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/layout-helpers.js"); ?>"></script>
    <script src="<?php echo base_url("assets/admin/js/material-ripple.js"); ?>"></script>
   
</body>
</html>
