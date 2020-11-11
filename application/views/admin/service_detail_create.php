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
      <div class="page-header">
        <?php
          foreach ($category as $category) {
        ?>
        <h3 class="page-title"><?=$category->service_category_code?> - <?=$category->service_category_name?></h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form id="edit-profile" method="post" action="<?php echo base_url();?>Controller_Service/saveDataDetail/<?php echo $category->service_category_code;?>" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                          <div class="form-group row" hidden>
                              <label class="col-sm-3 col-form-label" for="service_detail_name">ID</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" id="service_detail_name" name="service_detail_name">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="service_detail_name">Service Detail Name</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" id="service_detail_name" name="service_detail_name">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="Icon">Icon</label>
                              <div class="col-sm-9">
                                 <input type="file" class="span3" id="icon" name="icon">
                                 <?php 
                                  if(isset($error))
                                  {
                                      echo "ERROR UPLOAD : <br/>";
                                      print_r($error);
                                      echo "<hr/>";
                                  }
                                 ?>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Save</button>
                           <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Service/getAllServiceDetailByCategory/<?=$category->service_category_code?>" class="btn">Back</a>
                        </fieldset>
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