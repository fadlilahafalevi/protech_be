<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Majestic Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/protechapp/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/protechapp/assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="/protechapp/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/protechapp/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/protechapp/assets/images/favicon.png" />
  <!-- datepicker tempus dominus -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.html"><img src="/protechapp/assets/images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/protechapp/assets/images/logo-mini.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <!-- <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li> -->
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <?php 
            if($this->session->userdata('akses')=='3'){
          ?>
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <?php if ($count_order_NC > 0) { ?>
              <span class="count"></span>
              <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item" href="/protechapp/index.php/Controller_Order/getWaitingConfirmationOrder">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Need Confirmation Order</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
                <a href=""></a>
              </a>
            </div>
          </li>
          <?php } ?>
          <?php
            if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2' || $this->session->userdata('akses')=='3' || $this->session->userdata('akses') == '4'){
          ?>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="/protechapp/assets/images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name"><?=$this->session->userdata('user_name');?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <?php
                if($this->session->userdata('akses')=='3' || $this->session->userdata('akses') == '4'){
              ?>
              <a class="dropdown-item" href="/protechapp/index.php/Controller_Settings">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <?php
                }
              ?> 
              <a class="dropdown-item" href="/protechapp/index.php/Controller_Login/logout">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <?php } else { ?>
          <li class="nav-item nav-profile dropdown">
            <a class="btn btn-primary" type="button" id="btnLogin" data-toggle="Login" href="<?php echo base_url() . 'Controller_Login' ?>">LOGIN</a> &nbsp;&nbsp;
            <a class="btn btn-primary" type="button" id="btnRegister" data-toggle="Register" href="<?php echo base_url() . 'Controller_Customer/createCustomer' ?>">REGISTER</a>
          </li>
          <?php } ?>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
</body>

    <!-- plugins:js -->
    <!-- <script src="/protechapp/assets/vendors/base/vendor.bundle.base.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="/protechapp/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/protechapp/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/protechapp/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/protechapp/assets/js/off-canvas.js"></script>
    <script src="/protechapp/assets/js/hoverable-collapse.js"></script>
    <script src="/protechapp/assets/js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/protechapp/assets/js/dashboard.js"></script>
    <script src="/protechapp/assets/js/data-table.js"></script>
    <script src="/protechapp/assets/js/jquery.dataTables.js"></script>
    <script src="/protechapp/assets/js/dataTables.bootstrap4.js"></script>
    <!-- End custom js for this page-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGy2H319xQJ1TvHd5j1mDpqT-m-M1G93E&callback=initialize&libraries=places" async defer></script>
    <script type="text/javascript">
      $(document).ready(function(){  
        $('.data-table').dataTable();      
      });
    </script>
</html>