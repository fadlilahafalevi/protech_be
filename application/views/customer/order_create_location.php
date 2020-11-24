<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>PROTECH</title>
   <style>
      #map {
        width: 100%;
        height: 300px;
        border: 1px solid #000;
      }
   </style>
    <!-- <link rel="stylesheet" type="text/css" href="/Protech_BE/assets/datetimepicker/bootstrap.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="/Protech_BE/assets/datetimepicker/DateTimePicker.css" />
    <script type="text/javascript" src="/Protech_BE/assets/datetimepicker/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/Protech_BE/assets/datetimepicker/bootstrap.min.js"></script> 
    <script type="text/javascript" src="/Protech_BE/assets/datetimepicker/DateTimePicker.js"></script>
    <script type="text/javascript" src="/Protech_BE/assets/datetimepicker/i18n/DateTimePicker-i18n.js"></script>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">Choose Your Location</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                  <?php
                  foreach ($data as $service_detail) {
                  ?>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/searchTechnician'; ?>">
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="service_detail_code">Service Detail Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service_detail_code" name="service_detail_code" value="<?=$service_detail->service_detail_code?>">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="service">Service</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="service" name="service" value="<?=$service_detail->service_category_name?> - <?=$service_detail->service_detail_name?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_datetime">Order Datetime</label>
                           <div class="col-sm-6">
                              <div class="form-group">
                                  <div class="input-group date" id="order_datetime">
                                      <input type="text" class="form-control" id="order_datetime" name="order_datetime" data-field="datetime" data-format="dd-MMM-yyyy HH:mm:ss" readonly>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fix_datetime">Fixing Datetime</label>
                           <div class="col-sm-6">
                              <div class="form-group">
                                  <div class="input-group date" id="fix_datetime" data-target-input="nearest">
                                      <input type="text" id="fix_datetime" name="fix_datetime" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                      <span class="input-group-addon" data-target="#fix_datetime" data-toggle="datetimepicker">
                                          <span class="fa fa-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Full Address</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="full_address" name="full_address" readonly="readonly"></textarea>
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="latitude" name="latitude" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="longitude" name="longitude" readonly="readonly">
                           </div>
                        </div>
                        <input type="text" class="form-control" id="searchInput" name="searchInput">
                        <div id="map"></div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Search</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Technician">Back</a>
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
</div>
<div id="dtBox"></div>
<?php require 'application/views/footer.php'; ?>

<script type="text/javascript">
    
   $(document).ready(function(){
   
     $("#dtBox").DateTimePicker();
   
 });

</script>

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
</body>
</html>