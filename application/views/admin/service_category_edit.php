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
                  <h4 class="card-title">Ubah Data Kategori Layanan</h4>
                  <?php
                     foreach ($data as $service_category_detail) {
                  ?>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_ServiceCategory/updateData'; ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Kategori Layanan</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_category_code" name="service_category_code" value="<?=$service_category_detail->service_category_code?>" readonly/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Kategori Layanan</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_category_name" name="service_category_name" value="<?=$service_category_detail->service_category_name?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Menggunakan Instalasi?</label>
                          <div class="col-sm-9">
                            <input type="checkbox" onchange="document.getElementById('harga_instalasi').readOnly = !this.checked;" name="instalasi_cb" id="instalasi_cb" <?php if($instalasi_pengecekan[0]->price_instalasi > 0) { ?> checked <?php } ?> />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" hidden>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Code Instalasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="code_instalasi" name="code_instalasi" value="<?=$instalasi_pengecekan[0]->code_instalasi?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga Layanan Instalasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="harga_instalasi" name="harga_instalasi" value="<?=$instalasi_pengecekan[0]->price_instalasi?>" <?php if($instalasi_pengecekan[0]->price_instalasi <= 0) { ?> readOnly <?php } ?>/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" hidden>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Code Layanan Pengecekan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="code_pengecekan" name="code_pengecekan" value="<?=$instalasi_pengecekan[0]->code_pengecekan?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga Layanan Pengecekan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="harga_pengecekan" name="harga_pengecekan" value="<?=$instalasi_pengecekan[0]->price_pengecekan?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                              <?php if ($service_category_detail->active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" checked value="1">
                              <?php } else if ($service_category_detail->active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" value="0">
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceCategory">Kembali</a>
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