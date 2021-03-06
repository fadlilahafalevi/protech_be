<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PROTECH</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/protech/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/protech/assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/protech/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/protech/assets/images/logo_mini.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" >
              <div class="brand-logo">
                <img src="/protech/assets/images/logo.png" style="display: block; margin-left: auto; margin-right: auto;width: 200px;height: 50px;" alt="logo">
              </div>
              <br/>
              <center>
                <h4>Hello! Let's get started</h4>
                <h6 class="font-weight-light">Login to continue.</h6>
              </center>
              <form class="pt-3" action="<?php echo base_url() . 'Controller_Login/cekuser' ?>" method="post">
                <div class="form-group">
                  <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <p align="center" style="color: red"><?php echo $this->session->flashdata('msg'); ?></p>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                  <br/>
                  <center>
                    <h5>Don't have an account? Register <a href="<?php echo base_url() . 'Controller_Customer/createCustomer' ?>" target="_blank">here </a></h5>
                  </center>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/protech/assets/vendors/base/vendor.bundle.base.js"></script>

  <!-- endinject -->
  <!-- inject:js -->
  <script src="/protech/assets/js/off-canvas.js"></script>
  <script src="/protech/assets/js/hoverable-collapse.js"></script>
  <script src="/protech/assets/js/template.js"></script>
  <!-- endinject -->
</body>

</html>