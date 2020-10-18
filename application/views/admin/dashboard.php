<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DASHBOARD</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/Protech_BE/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/Protech_BE/assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="/Protech_BE/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/Protech_BE/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/Protech_BE/assets/images/favicon.png" />
</head>
<body>

<div class="container-fluid page-body-wrapper">
  <?php require 'application/views/header.php'; ?>
  <?php require 'application/views/sidebar.php'; ?>
  <!-- main -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
              <div class="mr-md-3 mr-xl-5">
                <h2>Welcome back,</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                <i class="mdi mdi-download text-muted"></i>
              </button>
              <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                <i class="mdi mdi-clock-outline text-muted"></i>
              </button>
              <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                <i class="mdi mdi-plus text-muted"></i>
              </button>
              <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body dashboard-tabs p-0">
              <ul class="nav nav-tabs px-4" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="purchases-tab" data-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>
                </li>
              </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-basket-fill icon-lg mr-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">New</small>
                              <h5 class="mr-2 mb-0">10</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-rotate-right mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">On Process</small>
                            <h5 class="mr-2 mb-0">7</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-check-all mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Done</small>
                            <h5 class="mr-2 mb-0">5</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-truck-delivery mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Delivered</small>
                            <h5 class="mr-2 mb-0">5</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">REQUEST NEED TO BE APPROVE</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Request Number</th>
                            <th>Request Date</th>
                            <th>Requester</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>20200822040815</td>
                            <td>22 Aug 2020</td>
                            <td>sharon.natalia</td>
                            <td>Add Customer</td>
                            <td>
                              <button class="btn btn-success" type="button">Approve</button>
                              <button class="btn btn-danger" type="button">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>20200822041001</td>
                            <td>22 Aug 2020</td>
                            <td>fadlilah.falevi</td>
                            <td>Add Customer</td>
                            <td>
                              <button class="btn btn-success" type="button">Approve</button>
                              <button class="btn btn-danger" type="button">Reject</button>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!-- end content wrapper -->
    </div>
    
    <?php require 'application/views/footer.php'; ?>
  <!-- end main -->
  </div>
</div>

  <!-- plugins:js -->
  <script src="/Protech_BE/assets/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="/Protech_BE/assets/vendors/chart.js/Chart.min.js"></script>
  <script src="/Protech_BE/assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/Protech_BE/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/Protech_BE/assets/js/off-canvas.js"></script>
  <script src="/Protech_BE/assets/js/hoverable-collapse.js"></script>
  <script src="/Protech_BE/assets/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/Protech_BE/assets/js/dashboard.js"></script>
  <script src="/Protech_BE/assets/js/data-table.js"></script>
  <script src="/Protech_BE/assets/js/jquery.dataTables.js"></script>
  <script src="/Protech_BE/assets/js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
</body>
</html>