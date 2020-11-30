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
      <div class="content-wrapper">
      <!-- <div class="page-header">
         <h3 class="page-title">Basic Tables</h3>
      </div> -->
      <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Wallet</h4>
               </p>
               <div class="table-responsive">

                  <h2>
                     <?php if($balance > 0) {?>
                        <?=$balance?>
                     <?php } else { echo "0";}?>
                  </h2>
                  <br><br><br><br><br><br>

                  <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Customer/goTopUp/<?=$this->session->userdata('code')?>">Top up</a>
                  

               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
      </div>
      <?php require 'application/views/footer.php'; ?>
   </body>
</html>