<!DOCTYPE html>
<html>
<head>
  <title></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/protech/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/protech/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/protech/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/protech/assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="/protech/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/protech/assets/css/demo_2/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/protech/assets/images/logo_mini.png" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="/protech/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
</head>
<body>
    <div class="container-scroller">
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="/protech">
                <img src="/protech/assets/images/logo.png" alt="logo" />
              </a>
              <a class="navbar-brand brand-logo-mini"><img src="/protech/assets/images/logo_mini.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                  
                </li>
              </ul>

              <?php if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3') { ?>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">

                    </div>
                    <div class="nav-profile-text">
                        <p class="text-black font-weight-semibold m-0"> Hello, <?=$this->session->userdata('fullname');?> ! <i class="mdi mdi-chevron-down"></i></p>
                    </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/protech/index.php/Controller_Login/logout">
                      <i class="mdi mdi-logout mr-2 text-primary"></i> Log Out </a>
                  </div>
                </li>
              </ul>
              <?php } else { ?>
                  <a class="btn btn-primary" type="button" id="btnLogin" data-toggle="Login" href="<?php echo base_url() . 'Controller_Login' ?>">LOGIN</a> &nbsp;&nbsp;
                  <a class="btn btn-primary" type="button" id="btnRegister" data-toggle="Register" href="<?php echo base_url() . 'Controller_Customer/createCustomer' ?>">REGISTER</a>
              <?php } ?>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
</body>

    <!-- plugins:js -->
    <script src="/protech/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/protech/assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="/protech/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/protech/assets/vendors/flot/jquery.flot.js"></script>
    <script src="/protech/assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="/protech/assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="/protech/assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="/protech/assets/vendors/flot/jquery.flot.stack.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/protech/assets/js/off-canvas.js"></script>
    <script src="/protech/assets/js/hoverable-collapse.js"></script>
    <script src="/protech/assets/js/misc.js"></script>
    <script src="/protech/assets/js/settings.js"></script>
    <script src="/protech/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/protech/assets/js/dashboard.js"></script>
    <script src="/protech/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/protech/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAjQA6g48aCcxzRt-lsxin_XZX2vloSKw&callback=initialize&libraries=places" async defer></script>
    <script type="text/javascript">
      $(document).ready(function(){  
        $('.data-table').dataTable();      
      });
    </script>
</html>