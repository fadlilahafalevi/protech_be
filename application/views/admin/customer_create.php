<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>
  <style>
    #map {
      width: 100%;
      height: 300px;
      border: 1px solid #000;
    }
    #pemeliharaan {
      display: none;
    }
  </style>

  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" crossorigin="anonymous">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.0/moment-with-locales.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.min.js"></script>
  <link href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                  <h4 class="card-title">Registrasi</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Customer/saveData'; ?>">
                    <p class="card-description">
                      Informasi Pribadi
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Depan</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="first_name" name="first_name" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" required/>
                          </div>
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Tengah</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="middle_name" name="middle_name" />
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
                          <label class="col-sm-3 col-form-label">Nama Belakang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
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
                                      <input type="radio" class="form-check-input" name="gender" id="gender" value="P">
                                      Perempuan
                                    </label>
                                 </div>
                              </div>                        
                        </div>
                      </div>  
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="address" name="address" required></textarea>
                          </div>
                        </div>
                      </div>                                                            
                    </div>
                    <div class="row" hidden>
                       <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                       <div class="col-sm-9">
                          <input type="text" class="form-control" id="latitude" name="latitude" readonly="readonly" value="-6.158305">
                       </div>
                    </div>
                    <div class="row" hidden>
                       <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                       <div class="col-sm-9">
                          <input type="text" class="form-control" id="longitude" name="longitude" readonly="readonly" value="826.809371">
                       </div>
                    </div>
                    <input type="text" class="form-control" id="searchInput" name="searchInput" style="top: 8px;">
                    <div id="map"></div>
                    <br><br><br>
                    <p class="card-description">
                      Informasi Akun
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-light" href="/protechapp/index.php/Controller_Customer">Kembali</a>
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
  function initialize() {
    var latlng = new google.maps.LatLng(-6.175392, 106.827153);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });



    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder;
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });

        google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}

function bindDataToForm(address,lat,lng){
   document.getElementById('address').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}

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

  // Year
  for(var i = 0; i < 62; i++){
    var opt = document.createElement('option');
    opt.value = i + year;
    opt.text = i + year;
    yeardropdown.appendChild(opt);
  }

  // Month
  for(var i = 0; i < 12; i++){
    var opt = document.createElement('option');
    opt.value = i+1;
    opt.text = months[i];
    monthdropdown.appendChild(opt);
  }

  // Day
  for(var i = 0; i < daysInCurrMonth; i++){
    var opt = document.createElement('option');
    opt.value = i + 1;
    opt.text = i + 1;
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