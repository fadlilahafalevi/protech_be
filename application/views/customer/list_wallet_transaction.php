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
        <h3 class="page-title">Transaction History</h3>
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
                      <th style="text-align: center">Transaction Code</th>
                      <th style="text-align: center">Transaction Time</th>
                      <th style="text-align: center">Amount</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $transaction){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td style="text-align: center">
                            <?php
                            if($transaction->txn_code == 'TOPU'){
                            ?>
                            	TOP UP
                            <?php
                            } elseif($transaction->txn_code == 'WDRW') {
                            ?>
                            	WITHDRAWAL
                            <?php
                            } elseif($transaction->txn_code == 'PAYM') {
                            ?>
                            	PAYMENT
                            <?php
                              }
                            ?>
                          </td>
                          <td><?=$transaction->created_datetime?></td>
                          <td>Rp. <?php echo number_format($transaction->txn_amount,2,',','.')?></td>
                          <td style="text-align: center">
                            <?php
                            if($transaction->receipt == null && !($transaction->txn_code == 'PAYM' || $transaction->txn_code == 'WDRW')){
                            ?>
                                UPLOAD RECEIPT
                            <?php
                            } elseif(($transaction->receipt != null && $transaction->is_processed == 0) || ($transaction->txn_code == 'WDRW' && $transaction->is_processed == 0 && $transaction->is_approved == 0)) {
                            ?>
                                WAITING ADMIN CONFIRMATION
                            <?php
                              } elseif($transaction->is_processed == 1 && $transaction->is_approved == 0) {
                            ?>
                                REJECTED
                            <?php
                              } elseif($transaction->is_processed == 1 && $transaction->is_approved == 1) {
                            ?>
                                DONE
                            <?php
                              }
                            ?>
                          </td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/protech/index.php/Controller_Wallet/goUploadReceipt/<?=$transaction->id?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
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