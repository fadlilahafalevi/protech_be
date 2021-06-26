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

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/confirmOrder'; ?>" enctype="multipart/form-data">
      <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <?php foreach ($service_category as $service_category) { ?>
                  <h4 class="card-title">Formulir Pemesanan Jasa - <?php echo $service_category->service_category_name ?></h4>
                  <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category->service_category_code ?>" />
                  <?php } ?>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Jenis Layanan</label>
                          <div class="col-sm-9">
                            <select class="form-control" style="color: black" name="jenis_layanan" id="dropdown">
                              <?php if ($isInstalasiExists > 0) { ?>
                              <option value="INSTALASI">Instalasi</option>
                              <?php } ?>
                              <option value="PERBAIKAN">Perbaikan</option>
                              <option value="PEMELIHARAAN">Pemeliharaan</option>
                            </select> 
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="row" id="pemeliharaan">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tipe Layanan</label>
                            <div class="col-sm-9">
                              <?php foreach ($service_type as $service_type) { ?>
                              <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="service_type_code" id="service_type_code" value="<?php echo $service_type->service_type_code ?>">
                                  <?php echo $service_type->service_type_name ?> ( Rp <?php echo number_format($service_type->price,2,',','.'); ?> )
                                </label>
                              </div>
                            <?php } ?>
                            </div>
                            <div class="col-sm-4">
                            </div>                        
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                          <div class="col-sm-9">
                            <div class="form-group">
                              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input name="waktu_perbaikan" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                                </div>
                              </div>
                              <p align="left" style="color: red">Anda tidak bisa memilih tanggal yang sama untuk layanan yang sama</p>
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
                            <textarea readonly class="form-control" rows="4" cols="50" id="alamat" name="alamat" required ></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catatan Alamat</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="catatan_alamat" name="catatan_alamat" ></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" hidden>
                       <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                       <div class="col-sm-9">
                          <input type="text" class="form-control" id="latitude" name="latitude" readonly="readonly" value="<?php echo $customer_data[0]->latitude ?>">
                       </div>
                    </div>
                    <div class="row" hidden>
                       <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                       <div class="col-sm-9">
                          <input type="text" class="form-control" id="longitude" name="longitude" readonly="readonly" value="<?php echo $customer_data[0]->longitude ?>">
                       </div>
                    </div>
                    <input type="text" class="form-control" id="searchInput" name="searchInput" style="top: 8px;">
                    <div id="map"></div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                          <div class="col-sm-9">
                            <input type="file" class="span3" id="foto_kerusakan" name="foto_kerusakan">
                            <?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Detail Keluhan</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="50" id="detail_keluhan" name="detail_keluhan" required></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" hidden>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
                          <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="metode_pembayaran" name="metode_pembayaran" readonly="readonly" value="TRANSFER">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Pesan</button> 
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
    // const latlng = {
    //     lat: <?php echo $customer_data[0]->latitude ?>,
    //     lng: <?php echo $customer_data[0]->longitude ?>,
    // };
    // geocoder.geocode({ location: latlng }, (results, status) => {
    //   if (status === "OK") {
    //     if (results[0]) {
    //       // map.setZoom(11);
    //       // const marker = new google.maps.Marker({
    //       //   position: latlng,
    //       //   map: map,
    //       // });
    //       // infowindow.setContent(results[0].formatted_address);
    //       // infowindow.open(map, marker);
    //       bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
    //       infowindow.setContent(results[0].formatted_address);
    //       infowindow.open(map, marker);
    //     } else {
    //       window.alert("No results found");
    //     }
    //   } else {
    //     window.alert("Geocoder failed due to: " + status);
    //   }
    // });

    
    var latlng = new google.maps.LatLng(<?php echo $customer_data[0]->latitude ?>, <?php echo $customer_data[0]->longitude ?>);
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
      const latlng = {
        lat: this.getPosition().lat(),
        lng: this.getPosition().lng(),
      };
      geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
          if (results[0]) {
            // map.setZoom(11);
            // const marker = new google.maps.Marker({
            //   position: latlng,
            //   map: map,
            // });
            // infowindow.setContent(results[0].formatted_address);
            // infowindow.open(map, marker);
            bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          } else {
            window.alert("No results found");
          }
        } else {
          window.alert("Geocoder failed due to: " + status);
        }
      });
    });
    // google.maps.event.addListener(marker, 'dragend', function (event) {
    //   const latlng = {
    //     lat: parseFloat(this.getPosition().lat()),
    //     lng: parseFloat(this.getPosition().lng()),
    //   };
    //   document.getElementById("latbox").value = this.getPosition().lat();
    //   document.getElementById("lngbox").value = this.getPosition().lng();
    // });
}

function bindDataToForm(address,lat,lng){
   document.getElementById('alamat').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}

$("#dropdown").change(function(){
    var value = $(this).children("option:selected").val();
    $("#pemeliharaan").hide(); 
    
    if (value == "PEMELIHARAAN")
        $("#pemeliharaan").show();
});

 $(function() {
  var dateFormat = "YYYY-MM-DD HH:mm";
  var CurrDate = "27-06-2018";
  var MinDate = "01-06-2018";
  var maxVarDate = new Date();
  maxVarDate.setDate(maxVarDate.getDate() + 7)

  $("#datetimepicker1").datetimepicker({
    format: dateFormat,
    minDate: new Date(),
    maxDate: maxVarDate,
    disabledDates: [
      <?php foreach($existing_repair_datetime as $data) {
        echo "'".$data->repair_datetime."'".",";
      } ?>
    ]
     // disabledDates: ['2021-06-17']
  });
});
</script>

</body>
</html>