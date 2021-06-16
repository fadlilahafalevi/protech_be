<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>

    <style>
      input[type="text"][disabled] {
      }
    </style>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/searchTechnician'; ?>">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Detail Pemesanan</h4>
                  <p align="left" style="color: red"><?php echo $this->session->flashdata('msg'); unset($_SESSION['msg']);?></p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Layanan</label>
                        <div class="col-sm-9">
                          <?php if ($data[0]->jenis_layanan != null) { ?>
                          <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo  $data[0]->jenis_layanan ?>" disabled />
                          <?php } else { ?>
                          <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="PERBAIKAN" disabled />
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori Layanan</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="layanan" name="layanan" value="<?php echo $data[0]->service_category_name ?>" disabled />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Layanan</label>
                        <div class="col-sm-9">
                          <?php if ($data[0]->service_type_name != null) { ?>
                          <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data[0]->service_type_name ?>" disabled />
                           <?php } else { ?>
                          <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data[0]->order_description ?>" disabled />
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" disabled />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Detail Keluhan</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->detail_keluhan; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->alamat_pengerjaan; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Catatan Alamat</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->address_note; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                        <div class="col-sm-9">
                          <img width="415px" src="data:image/png;base64,<?php echo $data[0]->photo ?>" alt="Red dot" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Biaya</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="Rp <?php echo number_format($data[0]->order_price,2,',','.'); ?>" disabled />
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-sm-9">
                        <a class="btn btn-light" href="../getWaitingConfirmationOrder">Kembali</a>
                        <!-- <a class="btn btn-danger" href="../confirmOrderTechnician/<?php echo $data[0]->order_code ?>/SELESAI"><i class="mdi mdi-close-circle-outline"></i>&nbsp;Tolak</a> -->
                        <a class="btn btn-success" href="../confirmOrderTechnician/<?php echo $data[0]->order_code ?>/DITERIMA"><i class="mdi mdi-check-circle-outline"></i>&nbsp;Terima</a>
                      </div>
                      </div>
                    </div>

                    </div>

                </div>
              </div>
            </form>
            </div>
          </div>
        </form>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>

</body>
</html>