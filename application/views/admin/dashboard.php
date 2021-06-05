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
          <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Bar chart</h4>
                <canvas id="order_by_month_chart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Jumlah Order Berdasarkan Status</h4>
                <canvas id="order_by_status"></canvas>
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

  
</script>
</body>
</html>