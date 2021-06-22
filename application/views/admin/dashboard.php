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

<!-- services -->
  <div class="main-panel">
     <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Jumlah Teknisi Berdasarkan Keahlian</h4>
                <canvas id="chart_service_ref"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Jumlah Order Berdasarkan Status</h4>
                <canvas id="order_by_status"></canvas>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Jumlah Order Berdasarkan Bulan (Tahun <?php echo date("Y") ?>)</h4>
                <canvas id="order_by_month_chart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Konfirmasi Pembayaran</h4>
                <div class="table-responsive">
                  <table id="example" class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th style="text-align: center">No</th>
                        <th style="text-align: center">Kode Pesanan</th>
                        <th style="text-align: center">Total Pembayaran</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no=0;
                        foreach ($list as $list_report){
                        if ($list_report->payment_status == 'SUDAH UPLOAD') {
                        $no++;
                      ?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$list_report->order_code?></td>
                          <td>Rp <?php echo number_format($list_report->total_payment,2,',','.')?></td>
                          <td><?=$list_report->payment_status?></td>
                          <td style="text-align: center">
                              <button class="btn btn-primary" data-toggle="modal" data-target="#modalPembayaran-<?=$list_report->order_code?>" data-toggle="tooltip" title="Lihat Bukti" style="padding: 4px">
                                <i class="mdi mdi-file-image"></i>
                              </button>
                          </td>
                        </tr>
                        <?php } ?>
                      <?php } ?>    
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
<!-- content-wrapper ends -->
<?php require 'application/views/footer.php'; ?>
<script src="/protechapp/assets/js/Chart.min.js"></script>
<script src="/protechapp/assets/js/chart.js"></script>

<script type="text/javascript">
var doughnutPieData = {
  datasets: [{
    data: [<?php
        foreach ($service_ref as $data) {
          echo $data->count . ", ";
        }
      ?>],

    backgroundColor: [
      'rgba(255, 99, 132, 0.5)',
      'rgba(54, 162, 235, 0.5)',
      'rgba(255, 206, 86, 0.5)',
      'rgba(75, 192, 192, 0.5)',
      'rgba(153, 102, 255, 0.5)',
      'rgba(255, 159, 64, 0.5)'
    ],
    borderColor: [
      'rgba(255,99,132,1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)'
    ],
  }],

  // These labels appear in the legend and in the tooltips when hovering different arcs
  labels: [<?php
        foreach ($service_ref as $data) {
          echo "'".$data->service_name."'" . ", ";
        }
      ?>]
};

var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

var options = {
scales: {
  yAxes: [{
    ticks: {
      beginAtZero: true
    }
  }]
},
legend: {
  display: false
},
elements: {
  point: {
    radius: 0
  }
}

};

var data_order_status = {
  datasets: [{
    data: [<?php
        foreach ($order_by_status as $data) {
          echo $data->count . ", ";
        }
      ?>],

    backgroundColor: [
      'rgba(255, 99, 132, 0.5)',
      'rgba(54, 162, 235, 0.5)',
      'rgba(255, 206, 86, 0.5)',
      'rgba(75, 192, 192, 0.5)',
      'rgba(153, 102, 255, 0.5)',
      'rgba(255, 159, 64, 0.5)'
    ],
    borderColor: [
      'rgba(255,99,132,1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)'
    ],
  }],

  // These labels appear in the legend and in the tooltips when hovering different arcs
  labels: [<?php
        foreach ($order_by_status as $data) {
          echo "'".$data->status."'" . ", ";
        }
      ?>]
};

var data = {
    labels: [<?php
        foreach ($order_by_month as $data) {
          echo "'".$data->bulan."'" . ", ";
        }
      ?>],
    datasets: [{
      label: '# of Votes',
      data: [<?php
        foreach ($order_by_month as $data) {
          echo "'".$data->count."'" . ", ";
        }
      ?>],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };

if ($("#chart_service_ref").length) {
    var pieChartCanvas = $("#chart_service_ref").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }

if ($("#order_by_month_chart").length) {
  var barChartCanvas = $("#order_by_month_chart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: data,
    options: options
  });
}

if ($("#order_by_status").length) {
    var pieChartCanvas = $("#order_by_status").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: data_order_status,
      options: doughnutPieOptions
    });
  }

$('#example').dataTable( {
  "searching": false,   // Search Box will Be Disabled

  "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled

  "info": true,         // Will show "1 to n of n entries" Text at bottom

  "lengthChange": false // Will Disabled Record number per page
});
</script>
</body>
</html>