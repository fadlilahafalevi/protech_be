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
                  <h4 class="card-title">Lihat Data Jenis Layanan</h4>
                  <?php
                     foreach ($data as $service_type_detail) {
                  ?>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_type_code" name="service_type_code" value="<?= $service_type_detail->service_type_code ?>" disabled="disabled" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="service_category_code" disabled="disabled">
                            <?php foreach($list_service_category as $list_service_category){ ?>
                              <option value="<?php echo $list_service_category->service_category_code; ?>" <?php if($list_service_category->service_category_code == $service_type_detail->service_category_code) { ?>
                                selected <?php } ?> ><?php echo $list_service_category->service_category_name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_type_name" name="service_type_name" value="<?=$service_type_detail->service_type_name?>" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="price" name="price" value="<?=$service_type_detail->price?>" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="service_type_desc" name="service_type_desc" disabled="disabled"><?=$service_type_detail->service_type_desc?></textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Satuan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit" name="unit" value="<?=$service_type_detail->unit?>" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="type" disabled>
                              <option value="INSTALASI" <?php if ($service_type_detail->type == 'INSTALASI') { ?> selected <?php } ?> >Instalasi</option>
                              <option value="REPARASI" <?php if ($service_type_detail->type == 'REPARASI') { ?> selected <?php } ?> >Reparasi</option>
                              <option value="PEMELIHARAAN" <?php if ($service_type_detail->type == 'PEMELIHARAAN') { ?> selected <?php } ?> >Pemeliharaan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                              <?php if ($service_type_detail->active_status == 1) { ?>
                                 <label class="badge badge-success">Aktif</label>
                              <?php } else if ($service_type_detail->active_status == 0) { ?>
                                 <label class="badge badge-danger">Nonaktif</label>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceType">Kembali</a>
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