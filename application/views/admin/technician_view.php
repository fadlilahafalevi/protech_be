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
        <h3 class="page-title">View Technician</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $technician_detail) {
                     ?>
                    <form class="forms-sample">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="email">Email</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="email" name="email" value="<?=$technician_detail->email?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fullname">Fullname</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$technician_detail->fullname?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$technician_detail->phone?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="identity_number">Identity Number</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="identity_number" name="identity_number" value="<?=$technician_detail->identity_number?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="bank_account_number">Bank Account Number</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="<?=$technician_detail->bank_account_number?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Full Address</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="full_address" name="full_address" disabled="disabled"><?=$technician_detail->full_address?></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="avg_rate">Average Rate</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="avg_rate" name="avg_rate" value="<?=$technician_detail->avg_rate?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="active">Active Status</label>
                           <div class="col-sm-9">
                              <?php if ($technician_detail->active_status == 1) { ?>
                                 <label class="badge badge-success">Active</label>
                              <?php } else if ($technician_detail->active_status == 0) { ?>
                                 <label class="badge badge-danger">Inactive</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Service</h4>
                          <?php 
                            foreach ($list_checked_service_detail as $list_checked_service_detail){
                          ?>
                           <h4 class="card-title"><?=$list_checked_service_detail->service_category_name?></h4>
                           <?php foreach ($list_checked_service_detail->subs as $list_detail) {
                              $checkbox = "";
                              if($list_detail->is_checked == 1){
                                 $checkbox = "checked";
                              }
                              ?>
                            <div class="form-check form-check-flat form-check-primary">
                              <input type="checkbox" name="<?=$list_detail->service_detail_code?>" value="<?=$list_detail->service_detail_code?>" <?=$checkbox?> disabled="disabled"> <?=$list_detail->service_detail_name?>
                            </div>
                           <?php } ?>
                          <?php } ?>
                        </div>
                        </div>
                        <br>
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Technician">Back</a>
                     </form>
                     <?php
                        }
                     ?>
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