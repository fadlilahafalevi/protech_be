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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />|
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

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
                  <!-- <?php foreach ($data as $detail) { ?> -->
                  <h4 class="card-title">Detail Pemesanan</h4>
                  <!-- <?php } ?> -->

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
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->alamat_pengerjaan; ?></textarea>
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
                          <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->detail_keluhan; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                        <div class="col-sm-9">
                          <img width="560px" src="data:image/png;base64,<?php echo $data[0]->photo ?>" alt="Red dot" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $payment[0]->payment_method ?>" disabled />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Biaya</label>
                        <div class="col-sm-9">
                          <?php if ($data[0]->price != null) { ?>
                          <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="Rp <?php echo number_format($data[0]->price,2,',','.'); ?>" disabled />
                          <?php  } else { ?>
                          <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="Rp <?php echo number_format($data[0]->order_price,2,',','.'); ?>" disabled />
                          <?php } ?>
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