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
        <h3 class="page-title">List Order to be Confirmed</h3>
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
                      <th style="text-align: center">Order Date Time</th>
                      <th style="text-align: center">Not Yet Confirmed For</th>
                      <th style="text-align: center">Customer</th>
                      <th style="text-align: center">Technician</th>
                      <th style="text-align: center">Action</th>
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
                          <td><?=$data->created_datetime?></td>
                          <td><?=$data->hour_diff?></td>
                          <td style="text-align: center">
                          <?=$data->customer?>
                          </td>
                          <td style="text-align: center">
                          <?=$data->technician?>
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/protech/index.php/Controller_Order/getOneByCode/<?=$data->order_code?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
                            </a>
                            <a class="btn btn-danger" href="/protech/index.php/Controller_Order/rejectByAdmin/<?=$data->order_code?>" data-toggle="tooltip" title="Reject" style="padding: 4px">
                              <i class="mdi mdi-close-circle"></i>
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