<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>

  <style>

    .rating {
      unicode-bidi:bidi-override;
      direction:ltr;
      font-size:90px;
      display: flex;
      width: 100%;
      justify-content: center;
      overflow: hidden;
      height: 90px;
      position: relative;
    }
    .rating span.star {
        font-family:FontAwesome;
        font-weight:normal;
        font-style:normal;
        display:inline-block;
    }
    .rating span.star:hover {
        cursor:pointer;
    }
    .rating span.star:before {
        content:"\f006";
        padding-right:5px;
        color:#999999;
    }




    span.star.filled:before{ color:#e3cf7a; content:"\f005";}

    span.star.half-filled:before{
       
      content: "\f089";
      color:#e3cf7a;
      
    }
    span.star.half-filled:after{
       
      content: "\f006";
      color:#e3cf7a;
      margin-left:-50px;
    }


  </style>
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
                <h4 class="card-title">Jumlah Order Berdasarkan Status</h4>
                <canvas id="order_by_status"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">RATING</h4>
                <br><br><br><br><br>
                <p align="center" style="font-size:50px;"><?php echo number_format($average_rate[0]->average_rate,1,'.','.')?></p>
                <span class="rating" rating="<?php echo number_format($average_rate[0]->average_rate,1,'.','.')?>">
                <span class="star "></span>
                <span class="star "></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                </span>
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

var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
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

if ($("#order_by_status").length) {
    var pieChartCanvas = $("#order_by_status").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: data_order_status,
      options: doughnutPieOptions
    });
  }

$('.rating').each(function (event) {

  var rating = $(this).attr('rating');
  var i;
  for(i = 0; (i < rating); i++)
  {
        $(this).find('span.star').eq(i).addClass('filled');
  }
  if(rating % 1>0)
    $(this).find('span.star').eq(i-1).addClass('half-filled');
});
</script>
</body>
</html>