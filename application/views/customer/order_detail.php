<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>

    <style>
      input[type="text"][disabled] {
        width: 300px;
        background: 
            linear-gradient(#000, #000) center bottom 5px /calc(100% - 10px) 2px no-repeat;
        /*background-color: #fcfcfc;*/
        border: 0px solid;
        padding: 10px;
        color: black;
      }
    </style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />|
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/searchTechnician'; ?>">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <!-- <?php foreach ($data as $detail) { ?> -->
                  <h4 class="card-title">Detail Pemesanan</h4>
                  <!-- <?php } ?> -->

                    <div class="row">
                      <div class="form-group">
                        <label>Waktu Perbaikan</label>
                        <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="4" cols="50" disabled style="background-color: #ffffff; color: black;"><?php echo $data[0]->address; ?></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Foto Kerusakan</label>
                        <br>
                        <img src="data:image/png;base64,<?php echo $data[0]->photo ?>" style="max-width: 200px" alt="Red dot" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Detail Keluhan</label>
                        <textarea class="form-control" rows="4" cols="50" disabled style="background-color: #ffffff; color: black;"><?php echo $data[0]->detail_keluhan; ?></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <!-- <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                        <input disa type="text" class="form-control" style="border: 0px" value="Tunai" disabled>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Nama Teknisi</label>
                        <!-- <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                        <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $data[0]->nama_teknisi ?>" disabled>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Kategori Layanan</label>
                        <!-- <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                        <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $data[0]->service_category_name ?>" disabled>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Jenis Layanan</label>
                        <!-- <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                        <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $data[0]->service_type_name ?>" disabled>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label>Biaya</label>
                        <!-- <input disa type="text" class="form-control" style="border: 0px" value="<?php echo $waktu_perbaikan ?>" disabled> -->
                        <input disa type="text" class="form-control" style="border: 0px" value="Rp <?php echo number_format($data[0]->price,2,',','.'); ?>" disabled>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>
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
   document.getElementById('full_address').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}
</script>

<script type="text/javascript">
$(function() {
  $('#datetimepicker1').datetimepicker({
    format:'HH:mm'
  });
});
</script>

</body>
</html>