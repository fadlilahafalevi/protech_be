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
                  <h4 class="card-title">Tambah Data Kategori Layanan</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_ServiceCategory/saveData'; ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kode Kategori Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_category_code" name="service_category_code" value="<?= $service_category_code ?>" readonly="readonly" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Kategori Layanan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="service_category_name" name="service_category_name" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Menggunakan Instalasi?</label>
                          <div class="col-sm-9">
                            <input type="checkbox"  onchange="update(this);" name="instalasi_cb" id="instalasi_cb" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" hidden>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Layanan Instalasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_instalasi" name="nama_instalasi" value="Instalasi" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga Layanan Instalasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="harga_instalasi" name="harga_instalasi" value="0" readOnly required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" hidden>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Layanan Pengecekan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_pengecekan" name="nama_pengecekan" value="Pengecekan" readonly="readonly" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Harga Layanan Pengecekan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="harga_pengecekan" name="harga_pengecekan" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_ServiceCategory">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>
<script>
function update(feature) {
// Check
if(feature.checked == true) {
    document.getElementById('harga_instalasi').readOnly = false;
    document.getElementById('harga_instalasi').value = 0;
  }
  // Uncheck
  if(feature.checked == false){
    document.getElementById('harga_instalasi').readOnly = true;
    document.getElementById('harga_instalasi').value = 0;
  }
}
</script>
</body>
</html>