<!DOCTYPE html>
<html>
<head>
  <title>USER</title>
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
    <?php require 'application/views/header.php'; ?>
  <div class="container-fluid page-body-wrapper">
    <?php require 'application/views/sidebar.php'; ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">MASTER TECHNICIAN</h4>
                  <a class="btn btn-success" href="/Protech_BE/index.php/Controller_User/createUser">CREATE</a>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered data-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Technician Code</th>
                          <th>Technician Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no=0;
                          foreach ($data as $list_user){
                          $no++;
                        ?>
                          <tr>
                              <td><?=$no?></td>
                              <td><?=$list_user->user_code?></td>
                              <td><?=$list_user->fullname?></td>
                              <td>
                                <?php
                                  if($list_user->active_status == '1'){
                                ?>
                                    <label class="badge badge-success">Active</label>
                                <?php
                                  } elseif($list_user->active_status == '0'){
                                ?>
                                    <label class="badge badge-danger">Inactive</label>
                                <?php
                                  }
                                ?>
                              </td>
                              <td>
                                 <a class="btn btn-warning" href="/Protech_BE/index.php/Controller_User/updateUser/<?=$list_user->id?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                                  <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <?php
                                  if($list_user->active_status == '1'){
                                ?>
                                  <a class="btn btn-danger" href="/Protech_BE/index.php/Controller_User/inactivateUser/<?=$list_user->id?>" data-toggle="tooltip" title="Inactive" style="padding: 4px">
                                    <i class="mdi mdi-account-remove"></i>
                                  </a>
                                <?php
                                  } elseif($list_user->active_status == '0'){ 
                                ?>
                                  <a class="btn btn-primary" href="/Protech_BE/index.php/Controller_User/activateUser/<?=$list_user->id?>" data-toggle="tooltip" title="Activate" style="padding: 4px">
                                    <i class="mdi mdi-account-plus"></i>
                                  </a>
                                <?php
                                  }
                                ?>
                              </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
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
  <script type="text/javascript">
    $(document).ready(function(){  
      $('.data-table').dataTable();      
    });
  </script>
  <!-- End custom js for this page-->
</body>
</html>