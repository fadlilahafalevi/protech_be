<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ubah Detail Akun</h4>
                  <?php
                     foreach ($data as $customer_detail) {
                  ?>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Settings/update_password_submit'; ?>">
                    <p class="card-description">
                      Ubah Password
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password Lama</label>
                          <div class="col-sm-9">
                              <input type="hidden" class="form-control" id="user_code" name="user_code" value="<?=$customer_detail->user_code?>" readonly/>
                              <input type="text" class="form-control" id="password_lama" name="password_lama" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password Baru</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="password_baru" name="password_baru" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="konfirmasi_password" name="password_konfirmasi" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <p align="center" style="color: red"><?php echo $this->session->flashdata('msg'); unset($_SESSION['msg']);?></p>
                    <br>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_Settings">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                  </form>
                  <?php
                     }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>
</body>
</html>