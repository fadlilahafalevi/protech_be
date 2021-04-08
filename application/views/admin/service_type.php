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
                  <h4 class="card-title">Data Jenis Layanan</h4>
                </div>
                <div class="col-sm-2 col-12">
                  <a class="btn btn-primary btn-sm" style="margin-bottom: 20px;" href="/teknisi-app/index.php/Controller_ServiceType/createServiceType">Tambah</a> 
                  <a class="btn btn-primary btn-sm float-right" style="margin-bottom: 20px;" href="/teknisi-app/index.php/Controller_ServiceType/printServiceType">Cetak</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Kode Jenis Layanan</th>
                      <th style="text-align: center">Nama Jenis Layanan</th>
                      <th style="text-align: center">Kategori Layanan</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($list as $list_service_type){
                      $no++;
                    ?>
                      <tr>
                        <td><?=$list_service_type->service_type_code?></td>
                        <td><?=$list_service_type->service_type_name?></td>
                        <td><?=$list_service_type->service_category_name?></td>
                        <td style="text-align: center">
                          <?php
                            if($list_service_type->active_status == '1'){
                          ?>
                            <label class="badge badge-success">Aktif</label>
                          <?php
                            } elseif($list_service_type->active_status == '0'){
                          ?>
                            <label class="badge badge-danger">Nonaktif</label>
                          <?php
                            }
                          ?>
                        </td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_ServiceType/getOne/<?=$list_service_type->service_type_code?>" data-toggle="tooltip" title="Lihat" style="padding: 4px">
                            <i class="mdi mdi-eye"></i>
                          </a>
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_ServiceType/updateServiceType/<?=$list_service_type->service_type_code?>" data-toggle="tooltip" title="Ubah" style="padding: 4px">
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