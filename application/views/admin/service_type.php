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
          foreach ($detail as $detail) {
        ?>
        <h3 class="page-title"><?=$detail->service_category_name?> - <?=$detail->service_detail_name?> (<?=$detail->service_detail_code?>)</h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Service/getAllServiceDetailByCategory/<?=$detail->service_category_code?>">Back to Service Detail</a>
          <a class="btn btn-success" href="/protech/index.php/Controller_Service/createServiceType/<?=$detail->service_detail_code?>">Create</a>
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
                      <th style="text-align: center">ID</th>
                      <th style="text-align: center">Service Type Code</th>
                      <th style="text-align: center">Service Type Name</th>
                      <th style="text-align: center">Price</th>
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
                          <td><?=$no?></td>
                          <td><?=$list_service->service_type_code?></td>
                          <td><?=$list_service->service_type_name?></td>
                          <td>Rp. <?php echo number_format($list_service->price,2,',','.') ?></td>
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
                            <a class="btn btn-warning" href="/protech/index.php/Controller_Service/updateServiceType/<?=$list_service->service_type_code?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
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