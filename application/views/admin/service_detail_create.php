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
        <h3 class="page-title">Create Service Detail</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form id="edit-profile" method="post" action="<?php echo base_url() . 'Controller_ServiceDetail/saveData'; ?>" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="service_category_name">Service Category Name</label>
                                 <div class="col-sm-9">
                                    <select class="form-control" id="service_category_code" name="service_category_code">
                                       <?php
                                         foreach($list_service as $list_service) { ?>
                                             <option value="<?= $list_service->service_category_code; ?>"><?= $list_service->service_category_code;?> - <?= $list_service->service_category_name;?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="service_category_name">Service Category Name</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" id="service_category_name" name="service_category_name">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="price">Price</label>
                              <div class="col-sm-9">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-primary text-white">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price">
                                    <div class="input-group-append">
                                      <span class="input-group-text">.00</span>
                                    </div>
                                  </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="Icon">Icon</label>
                              <div class="col-sm-9">
                                 <input type="file" class="span3" id="icon" name="icon">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Save</button>
                           <a class="btn btn-light" href="/Protech_BE/index.php/Controller_ServiceDetail" class="btn">Back</a>
                        </fieldset>
                     </form>
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