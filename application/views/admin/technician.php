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
        <h3 class="page-title">Master Technician</h3>
        <a class="btn btn-success" href="/protech/index.php/Controller_Technician/createTechnician">Create</a>
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
                      <th style="text-align: center">Technician Code</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Technician Name</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $list_technician){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$list_technician->technician_code?></td>
                          <td><?=$list_technician->email?></td>
                          <td><?=$list_technician->fullname?></td>
                          <td style="text-align: center">
                            <?php
                              if($list_technician->active_status == '1'){
                            ?>
                                <label class="badge badge-success">Active</label>
                            <?php
                              } elseif($list_technician->active_status == '0'){
                            ?>
                                <label class="badge badge-danger">Inactive</label>
                            <?php
                              }
                            ?>
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/protech/index.php/Controller_Technician/getOne/<?=$list_technician->technician_code?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
                            </a>
                             <a class="btn btn-warning" href="/protech/index.php/Controller_Technician/updateTechnician/<?=$list_technician->technician_code?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
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