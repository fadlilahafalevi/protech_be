<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/protechapp/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/protechapp/assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/protechapp/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/protechapp/assets/images/logo_mini.png" />

  <!-- <script>
    setTimeout(function(){
      window.location.href = 'http://localhost/protechapp/';
    }, 5000);
  </script> -->
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" >
              <div class="brand-logo">
                <img src="/protechapp/assets/images/logo.png" style="display: block; margin-left: auto; margin-right: auto;width: 200px;height: 50px;" alt="logo">
              </div>
              <?php if (isset($expired_message)) { ?>
                <h6> <?php echo $expired_message ?> </h6>
              <?php } else if (isset($used_token_message)) { ?>
                <h6> <?php echo $used_token_message ?> </h6>
              <?php } else { ?>
                <h6>Verifikasi email <?php echo $token_data[0]->email ?> telah berhasil dilakukan. Anda akan diarahkan ke halaman login, atau klik <a href="http://localhost/protechapp/"> disini </a> untuk langsung ke halaman login.</h6>
              <?php } ?>
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
  <script src="/protechapp/assets/vendors/base/vendor.bundle.base.js"></script>

  <!-- endinject -->
  <!-- inject:js -->
  <script src="/protechapp/assets/js/off-canvas.js"></script>
  <script src="/protechapp/assets/js/hoverable-collapse.js"></script>
  <script src="/protechapp/assets/js/template.js"></script>
  <!-- endinject -->
</body>

</html>