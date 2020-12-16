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
        <h3 class="page-title">Dashboard</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
                <div class="card color-card-wrapper">
                  <div class="card-body">
                    <img class="img-fluid card-top-img w-100" src="../assets/images/dashboard/img_5.jpg" alt="" />
                    <div class="d-flex flex-wrap justify-content-around color-card-outer">
                      <div class="col-6 p-0 mb-4">
                        <div class="color-card primary m-auto">
                          <i class="mdi mdi-clock-outline"></i>
                          <p class="font-weight-semibold mb-0">Waiting Confirmation</p>
                          <span class="small"><b><?= $waiting_confirmation ?></b> Orders</span>
                        </div>
                      </div>
                      <div class="col-6 p-0 mb-4">
                        <div class="color-card bg-info m-auto">
                          <i class="mdi mdi-wrench"></i>
                          <p class="font-weight-semibold mb-0">In Progress</p>
                          <span class="small"><b><?= $in_progress ?></b> Orders</span>
                        </div>
                      </div>
                      <div class="col-6 p-0">
                        <div class="color-card bg-success m-auto">
                          <i class="mdi mdi-check-circle"></i>
                          <p class="font-weight-semibold mb-0">Finished</p>
                          <span class="small"><b><?= $finished ?></b> Orders</span>
                        </div>
                      </div>
                      <div class="col-6 p-0">
                        <div class="color-card bg-danger m-auto">
                          <i class="mdi mdi-close-circle"></i>
                          <p class="font-weight-semibold mb-0">Canceled</p>
                          <span class="small"><b><?= $canceled ?></b> Orders</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        <div class="col-lg-6 grid-margin stretch-card">
           <div class="card">
              <div class="card-body">
                 <h4 class="card-title">Wallet (Intermediary Account)</h4>
                 </p>
                 <div class="table-responsive">
                    <h2>
                       <?php if($balance > 0) {?>
                          Rp. <?php echo number_format($balance, 2, ',', '.') ?>
                       <?php } else { echo "0";}?>
                    </h2>
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