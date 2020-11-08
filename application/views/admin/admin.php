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
        <h3 class="page-title">Master Admin</h3>
        <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Admin/createAdmin">Create</a>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">ID</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Fullname</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($list as $list_admin){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td><?=$list_admin->email?></td>
                          <td><?=$list_admin->fullname?></td>
                          <td style="text-align: center">
                            <?php
                              if($list_admin->active_status == '1'){
                            ?>
                                <button disabled="disabled" class="btn btn-success">Active</button>
                            <?php
                              } elseif($list_admin->active_status == '0'){
                            ?>
                                <button disabled="disabled" class="btn btn-danger">Inactive</button>
                            <?php
                              }
                            ?>
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/Protech_BE/index.php/Controller_Admin/getOne/<?=$list_admin->id?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
                            </a>
                             <a class="btn btn-warning" href="/Protech_BE/index.php/Controller_Admin/updateAdmin/<?=$list_admin->id?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                              <i class="mdi mdi-pencil"></i>
                            </a>
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

<?php require 'application/views/footer.php'; ?>
</body>
</html>