<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEKNISI APP
    </title>
    <style type="text/css">
      #centered-text-table {
        text-align: center; 
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <?php require 'application/views/header.php'; ?>
    <?php require 'application/views/sidebar.php'; ?>
    <!-- first row starts here -->
    <div class="main-panel">
      <div class="content-wrapper">
        <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/inputOrder'; ?>">
          <input type="hidden" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" />
          <input type="hidden" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" />
          <input type="hidden" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" />
          <input type="hidden" class="form-control" id="catatan_alamat" name="catatan_alamat" value="<?php echo $catatan_alamat ?>" />
          <input type="hidden" class="form-control" id="foto_kerusakan" name="foto_kerusakan" value="<?php echo $foto_kerusakan ?>" />
          <!-- <img src="data:image/png;base64,<?php echo $foto_kerusakan ?>" alt="Red dot" /> -->
          <input type="hidden" class="form-control" id="detail_keluhan" name="detail_keluhan" value="<?php echo $detail_keluhan ?>" />
          <input type="hidden" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" />
          <input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" />
          <input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" />
          <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category_code ?>" />
          <input type="hidden" class="form-control" id="service_type_code" name="service_type_code" value="<?php echo $service_type_code ?>" />
          <input type="hidden" class="form-control" id="tech_code" name="tech_code" value="<?php echo $technician_code ?>" />
          <!-- <?php print_r($service_type) ?> -->
          <div class="col-12 grid-margin">
            <div class="card">
              <!-- <div class="card-body"> -->
                <div class="card-body" style="">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="layanan" name="layanan" value="<?php echo $service_type[0]->service_type_name ?>" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="3" disabled="disabled"><?php echo $alamat ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Detail Keluhan</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="3" disabled="disabled"><?php echo $detail_keluhan ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                          <div class="col-sm-9">
                            <img src="data:image/png;base64,<?php echo $foto_kerusakan ?>" alt="Red dot" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Teknisi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" value="<?php echo $technician[0]->first_name.' '.$technician[0]->middle_name.' '.$technician[0]->last_name ?>" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
                          <div class="col-sm-9">
                            <input type="tetx" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
                <br>
        <button style="align-content: center;" type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            <!-- </div> -->
          </div>
        </div>
            </form>
          </div>
<?php require 'application/views/footer.php'; ?>
      </div>
</body>
</html>
