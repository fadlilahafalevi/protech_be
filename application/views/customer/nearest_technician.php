<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEKNISI APP
    </title>
    <style>
      #map {
        width: 100%;
        height: 300px;
        border: 1px solid #000;
      }
      .view-group {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: row;
        flex-direction: row;
        padding-left: 0;
        margin-bottom: 0;
      }
      .thumbnail
      {
        /*width: 1514px;*/
        margin-bottom: 30px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
      }
      .item.list-group-item
      {
        float: none;
        width: 100%;
        background-color: #fff;
        margin-bottom: 30px;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
        padding: 0 1rem;
        border: 0;
      }
      .item.list-group-item .img-event {
        float: left;
        width: 30%;
      }
      .item.list-group-item .list-group-image
      {
        margin-right: 10px;
      }
      .item.list-group-item .thumbnail
      {
        margin-bottom: 0px;
        display: inline-block;
      }
      .item.list-group-item .caption
      {
        float: left;
        width: 70%;
        margin: 0;
      }
      .item.list-group-item:before, .item.list-group-item:after
      {
        display: table;
        content: " ";
      }
      .item.list-group-item:after
      {
        clear: both;
      }
    </style>
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" rel="stylesheet">
    <script crossorigin="anonymous" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://code.jquery.com/jquery-3.2.1.min.js">
    </script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
    </script>
    <script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
    </script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/protech/assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js">
    </script>
    <script type="text/javascript" src="/protech/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="/protech/assets/js/demo.js">
    </script>
  </head>
  <body>
    <?php require 'application/views/header.php'; ?>
    <?php require 'application/views/sidebar.php'; ?>
    <!-- first row starts here -->
    <div class="main-panel">
      <div class="content-wrapper">
        <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/confirmOrder'; ?>">
          <input type="hidden" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" />
          <input type="hidden" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" />
          <input type="hidden" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" />
          <input type="hidden" class="form-control" id="catatan_alamat" name="catatan_alamat" value="<?php echo $catatan_alamat ?>" />
          <input type="hidden" class="form-control" id="foto_kerusakan" name="foto_kerusakan" value="<?php echo $foto_kerusakan ?>" />
          <!-- <img src="data:image/png;base64,<?php echo $foto_kerusakan ?>" alt="Red dot" /> -->
          <input type="hidden" class="form-control" id="detail_keluhan" name="detail_keluhan" value="<?php echo $detail_keluhan ?>" />
          <input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" />
          <input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" />
          <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category_code ?>" />
          <input type="hidden" class="form-control" id="service_type_code" name="service_type_code" value="<?php echo $service_type_code ?>" />
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Nearest Technician
                </p>
                <div id="products" class="row view-group">
                  <?php foreach ($nearestTech as $teknisi) { ?>
                  <div class="item col-xs-4 col-lg-4 list-group-item">
                    <div class="thumbnail card">
                      <div class="img-event">
                        <img class="group list-group-image img-fluid" src="http://www.landscapingbydesign.com.au/wp-content/uploads/2018/11/img-person-placeholder.jpg" style="max-height: 250px" alt="" />
                      </div>
                      <div class="caption card-body">
                        <h4 class="group card-title inner list-group-item-heading">
                          <?php echo $teknisi->first_name.' '.$teknisi->middle_name.' '.$teknisi->last_name ?>
                          <input type="hidden" class="form-control" id="tech_code" name="tech_code" value="<?php echo $teknisi->tech_id ?>" />
                        </h4>
                        <p class="group inner list-group-item-text">
                          <?php echo number_format($teknisi->distance,2,',','.'); ?> KM
                        </p>
                        <div class="row">
                          <div class="col-xs-12 col-md-6">
                            <p class="lead">
                              <li class="mdi mdi-star">5</li>
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 col-md-6">
                            <button type="submit" class="btn btn-success">Pilih</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
            </form>
          </div>
<?php require 'application/views/footer.php'; ?>
      </div>
</body>
</html>
