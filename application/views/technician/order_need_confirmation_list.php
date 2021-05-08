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

  </head>
  <body>
    <?php require 'application/views/header.php'; ?>
    <?php require 'application/views/sidebar.php'; ?>
    <!-- first row starts here -->
    <div class="main-panel">
      <div class="content-wrapper">
        <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/confirmOrder'; ?>">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Order Menunggu Konfirmasi
                </p>
                <div id="products" class="row view-group">
                  <?php foreach ($data as $data) { ?>
                  <div class="item col-xs-4 col-lg-4 list-group-item">
                    <div class="thumbnail card">
                      <div class="img-event" style="margin-top: 10px">
                        <img class="group list-group-image img-fluid" src="data:image/png;base64,<?php echo $data->photo ?>" style="max-height: 250px" alt="" />
                      </div>
                      <div class="caption card-body">
                        <h4 class="group card-title inner list-group-item-heading">
                          <?php echo $data->order_code ?>
                          <br><br>
                          <?php echo $data->service_category_name.' - '.$data->service_type_name ?>
                          <!-- <input type="hidden" class="form-control" id="tech_code" name="tech_code" value="<?php echo $teknisi->tech_id ?>" /> -->
                        </h4>
                        <p class="group inner list-group-item-text">
                          <?php echo $data->nama_customer ?>
                        </p>
                        <div class="row">
                          <div class="col-xs-12 col-md-6">
                            <p class="lead">
                              
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="getOneAfterOrderByCode/<?php echo $data->order_code ?>">Pilih</a>
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
