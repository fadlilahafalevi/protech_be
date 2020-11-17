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
        <h3 class="page-title">Order Search Result</h3>
        <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Technician/createTechnician">Create</a>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form>
                <div class="form-group row" hidden>
                  <label class="col-sm-3 col-form-label" for="service_detail_code">Service Detail Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="service_detail_code" name="service_detail_code" value="<?php echo $service_detail_code ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-3 col-form-label" for="full_address">Address</label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="full_address" name="full_address" value="<?php echo $full_address?>" readonly="readonly">
                   </div>
                </div>
                <div class="form-group row" hidden>
                   <label class="col-sm-3 col-form-label" for="encoded_full_address">Encoded Address</label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="encoded_full_address" name="encoded_full_address" value="<?php echo $encoded_full_address?>" readonly="readonly">
                   </div>
                </div>
                <div class="form-group row" hidden>
                  <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" readonly>
                  </div>
                </div>
                <div class="form-group row" hidden>
                  <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-3 col-form-label" for="service">Service</label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="service" name="service" value="<?php echo $service?>" readonly="readonly">
                   </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="order_ordertime">Order Datetime</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="order_ordertime" name="order_ordertime" value="<?php echo $order_ordertime ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="fix_ordertime">Fixing Datetime</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fix_ordertime" name="fix_ordertime" value="<?php echo $fix_ordertime ?>" readonly>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">ID</th>
                      <th style="text-align: center">Technician Photo</th>
                      <th style="text-align: center">Technician Name</th>
                      <th style="text-align: center">Distance</th>
                      <th style="text-align: center">Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $list_technician){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td><img src="data:<?php echo $list_technician->pass_photo; ?>;base64,<?php echo $list_technician->pass_photo; ?>"></td>
                          <td><?=$list_technician->fullname?></td>
                          <td>
                            <?=$list_technician->distance?> km
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/Protech_BE/index.php/Controller_Order/confirmOrder/<?=$list_technician->tech_id . '/' . $encoded_full_address . '/' . $latitude . '/' . $longitude . '/' . $encoded_order_ordertime . '/' . $encoded_fix_ordertime . '/' . $service . '/' . $service_detail_code ?>" data-toggle="tooltip" title="Order" style="padding: 4px">
                              <i class="mdi mdi-calendar-today"></i>
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