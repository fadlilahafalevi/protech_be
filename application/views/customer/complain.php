<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-10 col-12">
          <h4 class="card-title">Data Pengaduan</h4>
        </div>
        <div class="col-sm-2 col-12">
          <a class="btn btn-primary btn-sm float-right" style="margin-bottom: 20px;" href="/teknisi-app/index.php/Controller_Complain/createComplain">Tambah</a>
        </div>
      </div>
      <div class="row">
        <?php 
          foreach ($list as $list_complain){
        ?>
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header">
              #<?=$list_complain->complain_code?>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?=$list_complain->subject?></h5>
              <p class="card-text"><?=$list_complain->complain_desc?></p>
              <a href="#" class="btn btn-primary"><?=$list_complain->complain_status?></a>
            </div>
          </div>
        </div>

        <!-- <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Kode Pengaduan : <?=$list_complain->complain_code?></h4>
              <h4 class="card-title">Kode Pesanan : <?=$list_complain->order_code?></h4> 
              <h4 class="card-title">Judul : <?=$list_complain->subject?></h4> 
              <h4 class="card-title">Deskripsi : <?=$list_complain->complain_desc?></h4> 
              <h4 class="card-title">Respon : <?=$list_complain->response?></h4> 
              <h4 class="card-title">Status : <?=$list_complain->complain_status?></h4>
            </div>
          </div>
        </div> -->
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>
<?php require 'application/views/footer.php'; ?>
</body>
</html>