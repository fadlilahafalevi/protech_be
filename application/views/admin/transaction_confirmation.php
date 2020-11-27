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
<div class="container-fluid page-body-wrapper">
  <div class="main-panel">
    <div class="content-wrapper pb-0">
      <div class="page-header">
        <h3 class="page-title">List Transaction to be Confirmed</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">No</th>
                      <th style="text-align: center">Transaction Date Time</th>
                      <th style="text-align: center">Transaction Type</th>
                      <th style="text-align: center">User Type</th>
                      <th style="text-align: center">Name</th>
                      <th style="text-align: center">Amount</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $list_transaction){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td><?=$list_transaction->txn_datetime?></td>
                          <td><?=$list_transaction->txn_code?></td>
                          <td style="text-align: center">
                            <?php
                              if($list_transaction->customer_name != null){
                            ?>
                                Customer
                            <?php
                              } elseif($list_transaction->tehcnician_name != null){
                            ?>
                                Technician
                            <?php
                              }
                            ?>
                          </td>
                          <td style="text-align: center">
                            <?php
                              if($list_transaction->customer_name != null){
                            ?>
                                <?=$list_transaction->customer_name?>
                            <?php
                              } elseif($list_transaction->tehcnician_name != null){
                            ?>
                                <?=$list_transaction->technician_name?>
                            <?php
                              }
                            ?>
                          </td>
                          <td><?=$list_transaction->txn_amount?></td>
                          <td style="text-align: center">
                            <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Wallet/confirmation/<?=$list_transaction->id?>" data-toggle="tooltip" title="confirmation" style="padding: 4px">
                              <i class="mdi mdi-check-circle"></i>
                            </a>
                          </td>
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