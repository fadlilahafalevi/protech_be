<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>PROTECH</title>
   <style>
      #map {
        width: 100%;
        height: 300px;
        border: 1px solid #000;
      }
   </style>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">Order Detail</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/inputOrder'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_code">Order Id</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_code" name="order_code" value="<?php echo $order_id?>" readonly="readonly">
                           </div>
                        </div>

                        <?php 
                         foreach ($customer as $customer) {
                        ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="customer">Customer</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="customer" name="customer" value="<?=$customer->fullname?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="customer_id">Customer ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="customer_id" name="customer_id" value="<?=$customer->id?>" readonly="readonly">
                           </div>
                        </div>
                        <?php } ?>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude?>" readonly="readonly"/>
                           </div>
                        </div>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude?>" readonly="readonly"/>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Address</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="full_address" name="full_address" value="<?php echo $full_address?>" readonly="readonly"/>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_ordertime">Order Datetime</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_ordertime" name="order_ordertime" value="<?php echo $order_ordertime?>" readonly="readonly"/>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fix_ordertime">Fixing Datetime</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fix_ordertime" name="fix_ordertime" value="<?php echo $fix_ordertime?>" readonly="readonly"/>
                           </div>
                        </div>

                        <?php 
                         foreach ($technician as $technician) {
                        ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="technician">Technician</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="technician" name="technician" value="<?=$technician->fullname?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="technician_id">Technician ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="technician_id" name="technician_id" value="<?=$technician->id?>" readonly="readonly">
                           </div>
                        </div>
                        <?php } ?>

                        <?php 
                         foreach ($service as $service) {
                        ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="service">Service</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service" name="service" value="<?=$service->service_category_name?> - <?=$service->service_detail_name?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="service_detail_code">Service Detail Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_detail_code" name="service_detail_code" value="<?=$service->service_detail_code?>" readonly="readonly">
                           </div>
                        </div>
                        <?php } ?>

                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fee">Fee</label>
                           <div class="col-sm-9">
                              <input type="number" class="form-control" id="fee" name="fee" value="10000" readonly="readonly">
                           </div>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Order</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Technician">Back</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>