<!DOCTYPE html>
<html>
<head>
  <title></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/Protech_BE/assets/css/demo_2/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/Protech_BE/assets/images/favicon1.png" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="/Protech_BE/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
</head>
<body>
    <div class="container-scroller">
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="/Protech_BE">
                <img src="/Protech_BE/assets/images/logo.png" alt="logo" />
                <!-- <span class="font-12 d-block font-weight-light">Responsive Dashboard </span> -->
              </a>
              <a class="navbar-brand brand-logo-mini" href="/Protech_BE"><img src="/Protech_BE/assets/images/logo.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                  
                </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">

                    </div>
                    <div class="nav-profile-text">
                      <?php if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3') { ?>
                        <p class="text-black font-weight-semibold m-0"> Hello, <?=$this->session->userdata('fullname');?> ! <i class="mdi mdi-chevron-down"></i></p>
                      <?php } ?>
                    </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/Protech_BE/index.php/Controller_Login/logout">
                      <i class="mdi mdi-logout mr-2 text-primary"></i> Log Out </a>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
</body>

    <!-- plugins:js -->
    <script src="/Protech_BE/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/Protech_BE/assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="/Protech_BE/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/Protech_BE/assets/vendors/flot/jquery.flot.js"></script>
    <script src="/Protech_BE/assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="/Protech_BE/assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="/Protech_BE/assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="/Protech_BE/assets/vendors/flot/jquery.flot.stack.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/Protech_BE/assets/js/off-canvas.js"></script>
    <script src="/Protech_BE/assets/js/hoverable-collapse.js"></script>
    <script src="/Protech_BE/assets/js/misc.js"></script>
    <script src="/Protech_BE/assets/js/settings.js"></script>
    <script src="/Protech_BE/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/Protech_BE/assets/js/dashboard.js"></script>
    <script src="/Protech_BE/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/Protech_BE/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAjQA6g48aCcxzRt-lsxin_XZX2vloSKw&callback=initialize&libraries=places" async defer></script>
    <script type="text/javascript">
      $(document).ready(function(){  
        $('.data-table').dataTable();      
      });
    </script>
</html>