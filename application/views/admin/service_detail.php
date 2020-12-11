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
        <?php
          foreach ($category as $category) {
        ?>
        <h3 class="page-title"><?=$category->service_category_code?> - <?=$category->service_category_name?></h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Service">Back to Service Category</a>
          <a class="btn btn-success" href="/protech/index.php/Controller_Service/createServiceDetail/<?=$category->service_category_code?>">Create</a>
        </div>
        <?php
        }
        ?>
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
                      <th style="text-align: center">Service Detail Code</th>
                      <th style="text-align: center">Service Detail Name</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $list_service){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$list_service->service_detail_code?></td>
                          <td><?=$list_service->service_detail_name?></td>
                          <td style="text-align: center">
                            <?php
                              if($list_service->active_status == '1'){
                            ?>
                                <label class="badge badge-success">Active</label>
                            <?php
                              } elseif($list_service->active_status == '0'){
                            ?>
                                <label class="badge badge-danger">Inactive</label>
                            <?php
                              }
                            ?>
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/protech/index.php/Controller_Service/getAllServiceTypeByDetail/<?=$list_service->service_detail_code?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-format-list-bulleted"></i>
                            </a>
                            <a class="btn btn-warning" href="/protech/index.php/Controller_Service/updateServiceDetail/<?=$list_service->service_detail_code?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                              <i class="mdi mdi-lead-pencil"></i>
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