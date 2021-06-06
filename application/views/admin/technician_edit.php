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
      <?php
        foreach ($data as $technician_detail) {
      ?>
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Technician/updateData'; ?>">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lihat Data Teknisi</h4>
                    <p class="card-description">
                      Informasi Pribadi
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Depan</label>
                          <div class="col-sm-9">
                              <input type="hidden" class="form-control" id="user_code" name="user_code" value="<?=$technician_detail->user_code?>" readonly/>
                              <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$technician_detail->first_name?>" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor KTP</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="identity_no" name="identity_no" value="<?=$technician_detail->identity_no?>" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Tengah</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?=$technician_detail->middle_name?>" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=$technician_detail->phone?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Belakang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$technician_detail->last_name?>" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                          <div class="col-sm-2">
                            <select class="form-control" style="color: black" name="tanggal_lahir" id="daydropdown"></select>
                          </div>
                          <div class="col-sm-3"> 
                            <select class="form-control" style="color: black" name="bulan_lahir" id="monthdropdown"></select>
                          </div>
                          <div class="col-sm-2"> 
                            <select class="form-control" style="color: black" name="tahun_lahir" id="yeardropdown"></select>
                          </div>
                        </div>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="address" name="address" required><?=$technician_detail->address?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <?php if ($technician_detail->gender == 'L') { ?>
                              <div class="col-sm-4">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="L" checked >
                                      Laki-laki
                                    </label>
                                 </div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="P" >
                                      Perempuan
                                    </label>
                                 </div>
                              </div>
                           <?php } else if ($technician_detail->gender == 'P') { ?>
                              <div class="col-sm-4">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="L" >
                                      Laki-laki
                                    </label>
                                 </div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="P" checked >
                                      Perempuan
                                    </label>
                                 </div>
                              </div>
                           <?php } ?>                        
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                              <?php if ($technician_detail->up_active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" checked value="1">
                              <?php } else if ($technician_detail->up_active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" value="0">
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Informasi Akun
                    </p>
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control" id="email" name="email" value="<?=$technician_detail->email?>" required disabled="disabled" />
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-10 col-12">
                      <h4 class="card-title">Keahlian</h4>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered data-table">
                      <thead>
                        <tr>
                          <th style="text-align: center">Kategori Layanan</th>
                          <th style="text-align: center">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no=0;
                          foreach ($list_checked_service_category as $list_checked_service_category){
                          $no++;
                        ?>
                          <tr>
                            <td style="text-align: center"><?=$list_checked_service_category->service_category_name?></td>
                            <td style="text-align: center"><input type="checkbox" name="<?=$list_checked_service_category->service_category_code?>" value="<?=$list_checked_service_category->service_category_code?>" 
                              <?php if($list_checked_service_category->checked == 'true') {?> 
                                checked 
                              <?php }?> ></td>
                          </tr>
                        <?php
                          }
                        ?>    
                      </tbody>
                    </table>
                  </div>
                  <a class="btn btn-light" href="/protechapp/index.php/Controller_Technician">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan</button> 
                </div>
              </div>
            </div>
          </div>
          </form>
          <?php
            }
          ?>
        </div>
      </div>
<?php require 'application/views/footer.php'; ?>

<script>
var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

function daysInMonth(month, year) {
  return new Date(year, month, 0).getDate();
}

function populateDates(){
  var today = new Date(),
      day = today.getUTCDate(),
      month = today.getUTCMonth(),
      year = 1960,
      yearNow = today.getUTCFullYear(),
      daysInCurrMonth = daysInMonth(month, year);

  var daySelected = <?php echo $data[0]->d_dob ?>,
      monthSelected = <?php echo $data[0]->m_dob ?>,
      yearSelected = <?php echo $data[0]->y_dob ?>;

  // Year
  for(var i = 0; i < 62; i++){
    var opt = document.createElement('option');
    opt.value = i + year;
    opt.text = i + year;
    if ((i + year) == yearSelected) {
      opt.selected = true;
    }
    yeardropdown.appendChild(opt);
  }

  // Month
  for(var i = 0; i < 12; i++){
    var opt = document.createElement('option');
    opt.value = i+1;
    opt.text = months[i];
    if ((i + 1) == monthSelected) {
      opt.selected = true;
    }
    monthdropdown.appendChild(opt);
  }

  // Day
  for(var i = 0; i < daysInCurrMonth; i++){
    var opt = document.createElement('option');
    opt.value = i + 1;
    opt.text = i + 1;
    if ((i + 1) == daySelected) {
      opt.selected = true;
    }
    daydropdown.appendChild(opt);
  }
}

var daydropdown = document.getElementById("daydropdown"),
    monthdropdown = document.getElementById("monthdropdown"),
    yeardropdown = document.getElementById("yeardropdown");

// Change handler for months
monthdropdown.onchange = function(){
  var newMonth = monthdropdown.options[monthdropdown.selectedIndex].value,
      newYear = yeardropdown.options[yeardropdown.selectedIndex].value;
  
  daysInCurrMonth = daysInMonth(newMonth, newYear);

  daydropdown.innerHTML = "";
  for(var i = 0; i < daysInCurrMonth; i++){
    var opt = document.createElement('option');
    opt.value = i + 1;
    opt.text = i + 1;
    daydropdown.appendChild(opt);
  }
}

populateDates();
</script>
</body>
</html>