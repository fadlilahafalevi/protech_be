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
        <h3 class="page-title">Edit Service Category</h3>
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
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Service/updateDataCategory'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="service_category_code">Service Category Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_category_code" name="service_category_code" value="<?=$service_detail->service_category_code?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="service_category_name">Service Category Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_category_name" name="service_category_name" value="<?=$service_detail->service_category_name?>">
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
                        <a class="btn btn-light" href="/protech/index.php/Controller_Service">Back</button>
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