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
                  <h4 class="card-title">Ubah Data Admin</h4>
                  <?php
                     foreach ($data as $admin_detail) {
                  ?>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Admin/updateData'; ?>">
                    <p class="card-description">
                      Informasi Pribadi
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Depan</label>
                          <div class="col-sm-9">
                              <input type="hidden" class="form-control" id="user_code" name="user_code" value="<?=$admin_detail->user_code?>" readonly/>
                              <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$admin_detail->first_name?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor KTP</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="identity_no" name="identity_no" value="<?=$admin_detail->identity_no?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Tengah</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?=$admin_detail->middle_name?>" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=$admin_detail->phone?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Belakang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$admin_detail->last_name?>"/>
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
                          <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                          <?php if ($admin_detail->gender == 'L') { ?>
                              <div class="col-sm-4">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="L" checked>
                                      Laki-laki
                                    </label>
                                 </div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="P">
                                      Perempuan
                                    </label>
                                 </div>
                              </div>
                           <?php } else if ($admin_detail->gender == 'P') { ?>
                              <div class="col-sm-4">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="L">
                                      Laki-laki
                                    </label>
                                 </div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="P" checked>
                                      Perempuan
                                    </label>
                                 </div>
                              </div>
                           <?php } ?>                          
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="address" name="address" required><?=$admin_detail->address?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                            <?php if ($this->session->userdata('akses') == 1) { ?>
                              <?php if ($admin_detail->up_active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" checked value="1" >
                              <?php } else if ($admin_detail->up_active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" value="0">
                              <?php } ?>
                            <?php } else { ?>
                              <?php if ($admin_detail->up_active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" checked value="1" disabled read-only >
                              <?php } else if ($admin_detail->up_active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" id="active_status" name="active_status" value="0" disabled read-only>
                              <?php } ?>
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
                            <input type="email" class="form-control" id="email" name="email" value="<?=$admin_detail->email?>" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" value="<?=$admin_detail->password?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_Admin">Kembali</a>
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