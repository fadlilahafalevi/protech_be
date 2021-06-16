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
                  <h4 class="card-title">Tambah Data Jenis Layanan</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_ServiceType/saveData'; ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_type_code" name="service_type_code" value="<?= $service_type_code ?>" readonly="readonly" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="service_category_code">
                            <?php foreach($list_service_category as $list_service_category){ ?>
                              <option value="<?php echo $list_service_category->service_category_code; ?>"><?php echo $list_service_category->service_category_name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Jenis Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_type_name" name="service_type_name" required></input>
                            <p align="left" style="color: red">Jangan menggunakan kata "Pengecekan" sebagai nama jenis layanan</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="price" name="price" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="service_type_desc" name="service_type_desc" required></textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Satuan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit" name="unit" required/>
                          </div>
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="type">
                              <option value="REPARASI">Reparasi</option>
                              <option value="PEMELIHARAAN">Pemeliharaan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceType">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>

<script type="text/javascript">
document.getElementById('service_type_name').addEventListener('keyup', function(e) {
    var text = document.getElementById('service_type_name').value();
        if (text.toUpperCase().search('MMM') !== -1) {
          alert('MMM is not allowed!');
          document.getElementById('service_type_name').value = '';
        }
        if (text.search('XXX') !== -1) {
            alert('XXX is not allowed!');
        }
    text = text.replace(/MMM/g,'');
    text = text.replace(/XXX/g,'');
},false);
alert(document.getElementById('service_type_name').value());
</script>

</body>
</html>