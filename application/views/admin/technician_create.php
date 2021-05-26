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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Technician/saveData'; ?>">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambah Data Teknisi</h4>
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
                          <label class="col-sm-3 col-form-label">Nomor KTP</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="identity_no" name="identity_no" required/>
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
                          <label class="col-sm-3 col-form-label">Nama Belakang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name"/>
                          </div>
                        </div>
                      </div>
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
                    <br>
                    <div class="row">
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
                          <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                          <div class="col-sm-9">
                            <div class="form-group">
                              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input name="waktu_perbaikan" type="text" class="form-control datepicker-input" data-target="#datetimepicker1" />
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                                </div>
                              </div>
                            </div>
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
                              <input type="email" class="form-control" id="email" name="email" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Akun OVO</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="account_number_ovo" name="account_number_ovo"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" id="password" name="password" required/>
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
                          foreach ($list_service_category as $list_service_category){
                          $no++;
                        ?>
                          <tr>
                            <td style="text-align: center"><?=$list_service_category->service_category_name?></td>
                            <td style="text-align: center"><input type="checkbox" name="<?=$list_service_category->service_category_code?>" value="<?=$list_service_category->service_category_code?>" > </td>
                          </tr>
                        <?php
                          }
                        ?>    
                      </tbody>
                    </table>
                  </div>
                    <a class="btn btn-light" href="/teknisi-app/index.php/Controller_Technician">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                </div>
              </div>
            </div>
          </div>
                  </form>
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
</script>
</body>
</html>