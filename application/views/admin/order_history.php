<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PROTECH</title>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">Order History</h3><div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Order/downloadOrderHistory">Download</a>
        </div>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">No</th>
                      <th style="text-align: center">Order Code</th>
                      <th style="text-align: center">Order Time</th>
                      <th style="text-align: center">Customer</th>
                      <th style="text-align: center">Technician</th>
                      <th style="text-align: center">Service</th>
                      <th style="text-align: center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $order){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td><?=$order->order_code?></td>
                          <td><?=$order->created_datetime?></td>
                          <td><?=$order->customer_name?></td>
                          <td><?=$order->technician_name?></td>
                          <td><?=$order->service?></td>
                          <td><?=$order->order_status?></td>
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