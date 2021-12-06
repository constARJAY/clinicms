<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Clinic Management System</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>"/>
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/modules/clinic-logo.png') ?>" />

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="<?= base_url('assets/images/modules/login-logo.jpg') ?>" style="width: 250px;" alt="logo">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy to see you again!</h6>
                            <form method="POST" action="<?= base_url('login/authenticate') ?>" class="pt-3">

                                <?php if ($this->session->flashdata('feedback') == "error") : ?>
                                    <div class="alert alert-danger">
                                        <b>Error!</b><span> Invalid email or password.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" 
                                            class="form-control form-control-lg border-left-0" 
                                            id="email"
                                            name="email" 
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-lock-outline text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="password" 
                                        class="form-control form-control-lg border-left-0" 
                                        id="password" 
                                        name="password"
                                        placeholder="Password">                        
                                    </div>
                                </div>
                                <div class="mt-3 py-3">
                                    <input type="submit" 
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        value="LOGIN">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end"></p>
                    </div>
                </div>
            </div>
        </div>



        <!-- base:js -->
        <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.pie.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/jqvmap/jquery.vmap.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.world.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/peity/jquery.peity.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.flot.dashes.js') ?>"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
        <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
        <script src="<?= base_url('assets/js/template.js') ?>"></script>
        <script src="<?= base_url('assets/js/settings.js') ?>"></script>
        <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
        <!-- endinject -->

        <!-- Font Awesome -->
        <script defer src="<?= base_url('assets/js/brands.js') ?>"></script>
        <script defer src="<?= base_url('assets/js/solid.js') ?>"></script>
        <script defer src="<?= base_url('assets/js/fontawesome.js') ?>"></script>
    </body>
</html>