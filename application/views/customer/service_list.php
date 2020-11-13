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
        <h3 class="page-title">Service List</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="row">
                  <?php 
                          foreach ($list_service_category as $list_service_category){
                        ?>
                <div class="col-md-3 dropdown-menu-static-demo">
                  <div class="dropdown">
                    <button class="btn btn-primary" type="button" id="dropdownMenuOutlineButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <?=$list_service_category->service_category_name?> </button>
                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuOutlineButton1">
                        <?php 
                          foreach ($list_service_category->subs as $list_service_detail){
                            if($list_service_category->service_category_code == $list_service_detail->service_category_code)
                            {
                        ?>
                          <a class="dropdown-item" href="/Protech_BE/index.php/Controller_Order/createOrder"><?=$list_service_detail->service_detail_name?> <i class="mdi mdi-code-greater-than float-right"></i></a>
                        <?php } } ?>
                    </div>
                  </div>
                </div>
                  <?php } ?>
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