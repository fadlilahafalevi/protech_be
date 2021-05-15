<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEKNISI APP
    </title>
  </head>
  <body>
    <?php require 'application/views/header.php'; ?>
    <?php require 'application/views/sidebar.php'; ?>

    <!-- Modal konfirmasi -->
    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tambah Layanan
                    </h4>
                    <button type="button" class="close" 
                       data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <form role="form" method="post" action="<?php echo base_url() . 'Controller_Order/inputOrder'; ?>">
                    <input type="hidden" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" />
                    <input type="hidden" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" />
                    <input type="hidden" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" />
                    <input type="hidden" class="form-control" id="catatan_alamat" name="catatan_alamat" value="<?php echo $catatan_alamat ?>" />
                    <input type="hidden" class="form-control" id="foto_kerusakan" name="foto_kerusakan" value="<?php echo $foto_kerusakan ?>" />
                    <input type="hidden" class="form-control" id="detail_keluhan" name="detail_keluhan" value="<?php echo $detail_keluhan ?>" />
                    <input type="hidden" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" />
                    <input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" />
                    <input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" />
                    <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category_code ?>" />
                    <input type="hidden" class="form-control" id="service_type_code" name="service_type_code" value="<?php echo $service_type_code ?>" />
                    <input type="hidden" class="form-control" id="tech_code" name="tech_code" value="<?php echo $technician_code ?>" />
                  Apakah anda yakin dengan data dan akan konfirmasi pesanan?
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-error" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Iya</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- first row starts here -->
    <div class="main-panel">
      <div class="content-wrapper">
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
                            <img width="560px" src="data:image/png;base64,<?php echo $foto_kerusakan ?>" alt="Red dot" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
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
                <button class="btn btn-success btn-md" data-toggle="modal" data-target="#myModalNorm"></i>Konfirmasi</button>
                </div>
            <!-- </div> -->
          </div>
        </div>
          </div>
<?php require 'application/views/footer.php'; ?>
      </div>
</body>
</html>
