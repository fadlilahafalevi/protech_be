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

      img {
        width: 20vw;
        height: 20vw;
        padding: 2vw;
      }

      input[type=radio] {
        display: none;
      }

      img:hover {
        opacity:0.6;
        cursor: pointer;
      }

      img:active {
        opacity:0.4;
        cursor: pointer;
      }

      input[type=radio]:checked + label > img {
        border: 20px solid rgb(0, 51, 196);
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
        <h3 class="page-title">Order <?=$order_code?></h3>
        <h3 class="page-title">Request New Service</h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/Protech_BE/index.php/Controller_Order/getAllByTechnicianCode/<?=$this->session->userdata('code')?>">Back to Order History</a>
        </div>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Request New Service Type</h4>
              <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/requestNewServiceSubmit/'.$order_code; ?>">
              <?php 
                foreach ($data as $service_type){
              ?>
                <div class="form-check form-check-flat form-check-primary">
                  <input type="checkbox" name="<?=$service_type->service_type_code?>" value="<?=$service_type->service_type_code?>" > <?=$service_type->service_type_name?> - Rp. <?=$service_type->price?>
                </div>
              <?php } ?>
              <button type="submit" class="btn btn-primary">Submit</button> 
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