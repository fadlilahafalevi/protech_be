<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>
    <!-- <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        rel="stylesheet">
    <script crossorigin="anonymous" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/teknisi-app/assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/teknisi-app/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/teknisi-app/assets/js/demo.js"></script> -->
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Cari Data Pengaduan</h4>
              <form class="form-inline justify-content-center">
                <label for="from_date">Mulai Tanggal</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="from_date" placeholder="yyyy-mm-dd">
                <div class="input-group-addon input-group-append" style="margin-right: 50px;">
                  <div class="input-group-text">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  </div>
                </div> 
                <label for="to_date">Sampai Tanggal</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="to_date" placeholder="yyyy-mm-dd">
                <div class="input-group-addon input-group-append" style="margin-right: 50px;">
                  <div class="input-group-text">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10 col-12">
                  <h4 class="card-title">Data Pengaduan</h4>
                </div>
                <div class="col-sm-2 col-12">
                  <a class="btn btn-primary btn-sm float-right" style="margin-bottom: 20px;" href="/teknisi-app/index.php/Controller_Complain/createComplain">Tambah</a> 
                  <a class="btn btn-primary btn-sm float-right" style="margin-bottom: 20px;" href="#">Cetak</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Kode Pengaduan</th>
                      <th style="text-align: center">Kode Pesanan</th>
                      <th style="text-align: center">Judul Pengaduan</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($list as $list_complain){
                      $no++;
                    ?>
                      <tr>
                        <td><?=$list_complain->complain_code?></td>
                        <td><?=$list_complain->order_code?></td>
                        <td><?=$list_complain->subject?></td>
                        <td style="text-align: center">
                          <?php
                            if($list_complain->active_status == '1'){
                          ?>
                            <label class="badge badge-success">Aktif</label>
                          <?php
                            } elseif($list_complain->active_status == '0'){
                          ?>
                            <label class="badge badge-danger">Nonaktif</label>
                          <?php
                            }
                          ?>
                        </td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_Complain/getOne/<?=$list_complain->complain_code?>" data-toggle="tooltip" title="Lihat" style="padding: 4px">
                            <i class="mdi mdi-eye"></i>
                          </a>
                          <a class="btn btn-primary" href="/teknisi-app/index.php/Controller_Complain/updateComplain/<?=$list_complain->complain_code?>" data-toggle="tooltip" title="Ubah" style="padding: 4px">
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