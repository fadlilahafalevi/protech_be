<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<section class="bg-light-blue pt-5 pb-5">
<div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 mb-3 mb-md-0">
        <span class="h2 d-block">Layanan apa yang Anda cari?</span>
      </div>
      <div class="col-lg-9">
        <div class="row">
        <?php 
          $no=0;
          foreach ($listCategory as $listCategory){
            $no++;
        ?>
          <div class="col-md-4 d-flex">
            <div class="card mb-3">
              <img class="card-img-top" src="https://via.placeholder.com/400x300/5fa9f8/ffffff" alt="Amanda Shah">
              <div class="card-body py-3">
                <center><h5 class="mb-0"><?php echo $listCategory->service_category_name ?></h5></center>
              </div>
              <div class="card-footer pt-0 border-top-0">
                <center><a href="Controller_Order/preorder/<?php echo $listCategory->service_category_code ?>" class="btn btn-success">Pesan</a></center>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- content-wrapper ends -->
<?php require 'application/views/footer.php'; ?>
</body>
</html>