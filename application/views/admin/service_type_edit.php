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
        <h3 class="page-title">Edit Service Type</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $service_detail) {
                     ?>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Service/updateDataType'; ?>">
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="id">ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="id" name="id" value="<?=$service_detail->id?>">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="service_detail_code">Service Detail Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_detail_code" name="service_detail_code" value="<?=$service_detail->service_detail_code?>">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="service_type_name">Service Type Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_type_name" name="service_type_name" value="<?=$service_detail->service_type_name?>">
                           </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="price">Price</label>
                            <div class="col-sm-9">
                                  <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Rp.</span>
                                  </div>
                                  <input type="text" class="form-control" id="price" name="price" value="<?=$service_detail->price?>">
                                </div>
                            </div>
                         </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="active">Active Status</label>
                           <div class="col-sm-9">
                              <?php if ($service_detail->active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" class="form-control" id="active_status" name="active_status" checked value="1">
                              <?php } else if ($service_detail->active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" class="form-control" id="active_status" name="active_status" value="0">
                              <?php } ?>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Service/getAllServiceTypeByDetail/<?=$service_detail->service_detail_code?>">Back</button>
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