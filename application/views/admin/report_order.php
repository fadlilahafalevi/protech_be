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
                  <h4 class="card-title">Laporan Pemesanan</h4>
                </div>
                <form class="form-inline justify-content-center" method="post" action="<?php echo base_url() . 'Controller_ReportOrder'; ?>" enctype="multipart/form-data">
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
                  <a class="btn btn-primary btn-sm" href="/protechapp/index.php/Controller_ReportOrder/printReportOrder/<?=$from_date?>/<?=$to_date?>">Cetak</a>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Kode Pesanan</th>
                      <th style="text-align: center">Nama Teknisi</th>
                      <th style="text-align: center">Waktu Perbaikan</th>
                      <th style="text-align: center">Status</th>
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
                        <td><?=$list_report->technician_name?></td>
                        <td><?=$list_report->repair_datetime?></td>
                        <td><?=$list_report->order_status?></td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/protechapp/index.php/Controller_ReportOrder/getOne/<?=$list_report->order_code?>" data-toggle="tooltip" title="Lihat" style="padding: 4px">
                            <i class="mdi mdi-eye"></i>
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