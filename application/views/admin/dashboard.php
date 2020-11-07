<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PROTECH</title>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/menubar.php'; ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>REQUEST NEED TO BE APPROVE</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Request Number</th>
                    <th>Request Date</th>
                    <th>Requester</th>
                    <th>Purpose</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>20200822040815</td>
                      <td>22 Aug 2020</td>
                      <td>sharon.natalia</td>
                      <td>Add Customer</td>
                      <td>
                        <button class="btn btn-success" type="button">Approve</button>
                        <button class="btn btn-danger" type="button">Reject</button>
                      </td>
                  </tr>
                  <tr>
                      <td>20200822041001</td>
                      <td>22 Aug 2020</td>
                      <td>fadlilah.falevi</td>
                      <td>Add Customer</td>
                      <td>
                        <button class="btn btn-success" type="button">Approve</button>
                        <button class="btn btn-danger" type="button">Reject</button>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<?php require 'application/views/extra.php'; ?>
<?php require 'application/views/footer.php'; ?>
</body>
</html>