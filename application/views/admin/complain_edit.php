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
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ubah Data Pengaduan</h4>
                  <?php
                     foreach ($data as $complain_detail) {
                  ?>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Complain/updateData'; ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Pengaduan</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="complain_code" name="complain_code" value="<?=$complain_detail->complain_code?>" readonly/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Pesanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$complain_detail->order_code?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Judul Pengaduan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="subject" name="subject" value="<?=$complain_detail->subject?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="complain_desc" name="complain_desc" readonly><?=$complain_detail->complain_desc?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Respon</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="response" name="response"><?=$complain_detail->response?></textarea>
                          </div>
                        </div>
                      </div>                                        
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status Pengaduan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="complain_status">
                              <option value="MENUNGGU" 
                                <?php if($complain_detail->complain_status == 'MENUNGGU') { ?> selected <?php } ?> >Menunggu
                              </option>
                              <option value="DALAM PROSES"
                                <?php if($complain_detail->complain_status == 'DALAM PROSES') { ?> selected <?php } ?> >Dalam Proses
                              </option>
                              <option value="SELESAI" 
                                <?php if($complain_detail->complain_status == 'SELESAI') { ?> selected <?php } ?> >Selesai
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/teknisi-app/index.php/Controller_Complain">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                  </form>
                  <?php
                     }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>
</body>
</html>