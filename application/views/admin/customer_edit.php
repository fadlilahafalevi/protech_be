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
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">Edit Customer</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $customer_detail) {
                     ?>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Customer/updateData'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="customer_code">Customer Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="customer_code" name="customer_code" value="<?=$customer_detail->customer_code?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="email">Email</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="email" name="email" value="<?=$customer_detail->email?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fullname">Fullname</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$customer_detail->fullname?>">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="phone_old">Phone Old</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone_old" name="phone_old" value="<?=$customer_detail->phone?>">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$customer_detail->phone?>">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="active">Active Status</label>
                           <div class="col-sm-9">
                              <?php if ($customer_detail->active_status == 1) { ?>
                                 <input class="form-check-input" type="checkbox" class="form-control" id="active_status" name="active_status" checked value="1">
                              <?php } else if ($customer_detail->active_status == 0) { ?>
                                 <input class="form-check-input" type="checkbox" class="form-control" id="active_status" name="active_status" value="1">
                              <?php } ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Full Address</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="full_address" name="full_address"><?=$customer_detail->full_address?></textarea>
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="latitude">Latitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="latitude" name="latitude" value="<?=$customer_detail->latitude?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="longitude">Longitude</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="longitude" name="longitude" value="<?=$customer_detail->longitude?>" readonly="readonly">
                           </div>
                        </div>
                        <input type="text" class="form-control" id="searchInput" name="searchInput">
                        <div id="map"></div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Save</button> 
                        <a class="btn btn-light" href="/protech/index.php/Controller_Customer">Back</a>
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
<?php require 'application/views/footer.php'; ?>

<script>
  function initialize() {
    var lat = parseFloat(document.getElementById('latitude').value);
    var long = parseFloat(document.getElementById('longitude').value);
    var latlng = new google.maps.LatLng(lat, long);
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