<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>

  <style>
    input[type="text"][disabled] {
      width: 413px;
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
      <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Detail Pemesanan</h4>

                <div class="row">
                  <div class="form-group">
                    <label>Waktu Perbaikan</label>
                    <input type="text" class="form-control" style="width: 413px;" value="<?php echo $waktu_perbaikan ?>" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="4" cols="50" disabled style="background-color: #ffffff; color: black;"><?php echo $data[0]->address; ?></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Foto Kerusakan</label>
                    <br>
                    <img src="data:image/png;base64,<?php echo $data[0]->photo ?>" style="max-width: 200px" alt="Red dot" />
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Detail Keluhan</label>
                    <textarea class="form-control" rows="4" cols="50" disabled style="background-color: #ffffff; color: black;"><?php echo $data[0]->detail_keluhan; ?></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <!-- <input type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                    <input type="text" class="form-control" style="border: 0px" value="Tunai" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Nama Customer</label>
                    <!-- <input type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                    <input type="text" class="form-control" style="border: 0px" value="<?php echo $data[0]->nama_customer ?>" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label>Kategori Layanan</label>
                    <!-- <input type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                    <input type="text" class="form-control" style="border: 0px" value="<?php echo $data[0]->service_category_name ?>" disabled>
                  </div>
                </div>

                <a class="btn btn-light" href="/teknisi-app/index.php/Controller_Order/getAllByTechnicianCode/<?=$data[0]->technician_code?>">Kembali</a>
                <?php if ($data[0]->order_status == 'MENUNGGU KONFIRMASI') { ?>
                <a class="btn btn-danger" href="../confirmOrderTechnician/<?php echo $data[0]->order_code ?>/SELESAI"><i class="mdi mdi-close-circle-outline"></i>&nbsp;Tolak</a>
                <a class="btn btn-success" href="../confirmOrderTechnician/<?php echo $data[0]->order_code ?>/DALAM PROSES"><i class="mdi mdi-check-circle-outline"></i>&nbsp;Terima</a>
                <?php } ?>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Detail Layanan</h4>
                <?php foreach ($data_detail as $data_detail) { ?>
                  <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                      <div class="d-flex flex-row align-items-center">
                        <i class="mdi mdi-checkbox-marked-outline icon-md text-warning"></i>
                          <p class="mb-0 ml-1">
                            <?=$data_detail->service_type_name?>
                          </p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
                <a class="btn btn-info" href="../requestNewService/<?php echo $data[0]->order_code ?>/<?php echo $data[0]->service_category_code ?>"><i class="mdi mdi-plus"></i>&nbsp;Tambah Layanan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require 'application/views/footer.php'; ?>

</body>
</html>