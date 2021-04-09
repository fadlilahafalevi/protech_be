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
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10 col-12">
                  <h4 class="card-title">Tambah Layanan</h4>
                </div>
              </div>
              <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/requestNewServiceSubmit/'.$order_code.'/'.$service_category_code; ?>">
              <?php 
                foreach ($data as $service_type){
              ?>
              <input type="hidden" name="price-<?=$service_type->service_type_code?>" value="<?=$service_type->price?>" >
                <div class="form-check form-check-flat form-check-primary">
                  <input type="checkbox" name="<?=$service_type->service_type_code?>" value="<?=$service_type->service_type_code?>" > <?=$service_type->service_type_name?> - Rp. <?=$service_type->price?>
                </div>
              <?php } ?>
              <a class="btn btn-light" href="/teknisi-app/index.php/Controller_Order/getOne/<?=$order_code?>">Kembali</a>
              <button type="submit" class="btn btn-primary">Submit</button> 
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