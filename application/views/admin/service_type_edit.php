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
                  <h4 class="card-title">Ubah Data Jenis Layanan</h4>
                  <?php
                     foreach ($data as $service_type_detail) {
                  ?>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_ServiceType/updateData'; ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_type_code" name="service_type_code" value="<?= $service_type_detail->service_type_code ?>" readonly="readonly" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="service_category_code">
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
                            <input type="text" class="form-control" id="service_type_name" name="service_type_name" value="<?=$service_type_detail->service_type_name?>" required/>
                            <p align="left" style="color: red">Jangan menggunakan kata "Pengecekan" sebagai nama jenis layanan</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="price" name="price" value="<?=$service_type_detail->price?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="service_type_desc" name="service_type_desc" required><?=$service_type_detail->service_type_desc?></textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Satuan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit" name="unit" value="<?=$service_type_detail->unit?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="type">
                              <option value="PERBAIKAN" <?php if ($service_type_detail->type == 'PERBAIKAN') { ?> selected <?php } ?> >Perbaikan</option>
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
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" checked value="1">
                              <?php } else if ($service_type_detail->active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" value="0">
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceType">Kembali</a>
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