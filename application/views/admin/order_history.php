<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PROTECH</title>
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        rel="stylesheet">
    <script crossorigin="anonymous" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/protech/assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/protech/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/protech/assets/js/demo.js"></script>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">Order History</h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Order/downloadOrderHistory/<?=$from?>/<?=$to?>">Download</a>
        </div>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
            <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/orderHistory'; ?>">
            <div class="form-group row">
                <label class="col-sm-1 col-form-label" for="from">From</label>
                 <div class="col-sm-3 input-group mb-2 mr-sm-2" id="from_date">
                    <input type="text" class="form-control" name="from" id="from" required/>
                    <div class="input-group-addon input-group-append">
                        <div class="input-group-text">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <label class="col-sm-1 col-form-label" for="to">To</label>
                 <div class="col-sm-3 input-group mb-2 mr-sm-2" id="to_date">
                    <input type="text" class="form-control" name="to" id="to" required/>
                    <div class="input-group-addon input-group-append">
                        <div class="input-group-text">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button> 
            </form>
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">No</th>
                      <th style="text-align: center">Order Code</th>
                      <th style="text-align: center">Order Time</th>
                      <th style="text-align: center">Customer</th>
                      <th style="text-align: center">Technician</th>
                      <th style="text-align: center">Service</th>
                      <th style="text-align: center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $order){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td><?=$order->order_code?></td>
                          <td><?=$order->created_datetime?></td>
                          <td><?=$order->customer_name?></td>
                          <td><?=$order->technician_name?></td>
                          <td><?=$order->service?></td>
                          <td><?=$order->order_status?></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require 'application/views/footer.php'; ?>
</body>
</html>