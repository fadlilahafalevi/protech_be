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

<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>

<?php foreach ($list as $list_report){ ?>
<!-- Modal Konfirmasi Pembayaran -->
<div class="modal fade" id="modalPembayaran-<?=$list_report->order_code?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
            <h3 align="center">Apakah bukti pembayaran sudah benar?</h3>
            </div>
            <img width="415px" src="data:image/png;base64,<?php echo $list_report->receipt ?>" alt="Gambar tidak tersedia" class="center" />
            <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
              <a class="btn btn-danger" href="/protechapp/index.php/Controller_ReportPayment/payment_admin_action/<?=$list_report->order_code?>/TOLAK">Tolak</a>
              <a class="btn btn-success" href="/protechapp/index.php/Controller_ReportPayment/payment_admin_action/<?=$list_report->order_code?>/TERIMA">Terima</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10 col-12">
                  <h4 class="card-title">Laporan Pembayaran</h4>
                </div>

                <form class="form-inline justify-content-center" method="post" action="<?php echo base_url() . 'Controller_ReportPayment'; ?>" enctype="multipart/form-data">
                <!-- <form class="form-inline justify-content-center"> -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mulai Tanggal</label>
                        <div class="col-sm-9">
                          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="from_date" type="search" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="<?php echo $from_date?>" read-only="true" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-9">
                          <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input name="to_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" value="<?php echo $to_date?>" read-only />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-success btn-sm">Filter</button>
                  &nbsp;
                  <a class="btn btn-primary btn-sm float-right" href="/protechapp/index.php/Controller_ReportPayment/printReportPayment/<?=$from_date?>/<?=$to_date?>">Cetak</a>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Kode Pesanan</th>
                      <th style="text-align: center">Metode Pembayaran</th>
                      <th style="text-align: center">Tanggal Pembayaran</th>
                      <th style="text-align: center">Total Pembayaran</th>
                      <th style="text-align: center">Nama Teknisi</th>
                      <th style="text-align: center">Nama Pelanggan</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($list as $list_report){
                      $no++;
                    ?>
                      <tr>
                        <td><?=$list_report->order_code?></td>
                        <td><?=$list_report->payment_method?></td>
                        <td><?=$list_report->payment_date?></td>
                        <td><?=$list_report->total_payment?></td>
                        <td><?=$list_report->technician_name?></td>
                        <td><?=$list_report->customer_name?></td>
                        <td style="text-align: center">
                          <?php if ($list_report->payment_status == 'SUDAH UPLOAD') { ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalPembayaran-<?=$list_report->order_code?>" data-toggle="tooltip" title="Lihat Bukti" style="padding: 4px">
                              <i class="mdi mdi-file-image"></i>
                            </button>
                          <?php } ?>
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

<script>
$(function() {
  var dateFormat = "YYYY-MM-DD";

  $("#datetimepicker1").datetimepicker({
    format: dateFormat,
    ignoreReadonly: true
  });

  $("#datetimepicker2").datetimepicker({
    format: dateFormat,
    ignoreReadonly: true
  });
});
</script>

<?php require 'application/views/footer.php'; ?>
</body>
</html>