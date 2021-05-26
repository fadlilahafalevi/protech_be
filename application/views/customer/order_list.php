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
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10 col-12">
                  <h4 class="card-title">Data Teknisi</h4>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">No</th>
                      <th style="text-align: center">Kode Pesanan</th>
                      <th style="text-align: center">Tanggal Pengerjaan</th>
                      <th style="text-align: center">Kategori</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $data){
                      $no++;
                    ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data->order_code?></td>
                        <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $data->repair_datetime)->format('d/m/Y H:i') ?></td>
                        <td><?=$data->service_category_name?></td>
                        <td style="text-align: center">
                        <?php if ($data->order_status == 'MENUNGGU KONFIRMASI') { ?>
                        <label class="badge badge-danger">Menunggu Konfirmasi</label>
                        <?php } else if ($data->order_status == 'DITERIMA') { ?>
                        <label class="badge badge-warning">Diterima</label>
                        <?php } else if ($data->order_status == 'DALAM PROSES') { ?>
                        <label class="badge badge-warning">Dalam Proses</label>
                        <?php } else if ($data->order_status == 'MENUNGGU PEMBAYARAN') { ?>
                        <label class="badge badge-info">Menunggu Pembayaran</label>
                        <?php } else if ($data->order_status == 'SELESAI') { ?>
                        <label class="badge badge-success">Selesai</label>
                        <?php } ?>
                        </td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_Order/getOne/<?=$data->order_code?>" data-toggle="tooltip" title="Lihat" style="padding: 4px">
                            <i class="mdi mdi-eye btn-icon-prepend"></i>
                          </a>
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_Order/printDetailOrder/<?=$data->order_code?>" data-toggle="tooltip" title="Print Detail Order" style="padding: 4px">
                            <i class="mdi mdi-library-books"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require 'application/views/footer.php'; ?>
</body>
</html>