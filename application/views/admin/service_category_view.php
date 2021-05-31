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
                  <h4 class="card-title">Lihat Data Kategori Layanan</h4>
                  <?php
                     foreach ($data as $service_category_detail) {
                  ?>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Kategori Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_category_code" name="service_category_code" value="<?= $service_category_detail->service_category_code ?>" disabled="disabled" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Kategori Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_category_name" name="service_category_name" value="<?=$service_category_detail->service_category_name?>" disabled="disabled"/>
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
                                 <label class="badge badge-success">Aktif</label>
                              <?php } else if ($service_category_detail->active_status == 0) { ?>
                                 <label class="badge badge-danger">Nonaktif</label>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceCategory">Kembali</a>
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