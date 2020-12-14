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
        <h3 class="page-title">Wallet Transaction History</h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Wallet/downloadTransactionHistory">Download</a>
        </div>
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
                      <th style="text-align: center">Transaction Datetime</th>
                      <th style="text-align: center">Transaction Type</th>
                      <th style="text-align: center">From</th>
                      <th style="text-align: center">To</th>
                      <th style="text-align: center">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $transaction){
                      $no++;
                    ?>
                      <tr>
                          <td style="text-align: center"><?=$no?></td>
                          <td><?=$transaction->txn_datetime?></td>
                          <td> <?php if($transaction->txn_code == 'TOPU') {?>
                          TOP UP
                          <?php } elseif ($transaction->txn_code == 'WDRW') {?>
                          WITHDRAWAL
                          <?php } elseif ($transaction->txn_code == 'PAYM') {?>
                          ORDER (<?=$transaction->order_code?>)
                          <?php } ?>
                          </td>
                          <td><?=$transaction->NAME_FROM?></td>
                          <td><?=$transaction->NAME_TO?></td>
                          <td>Rp. <?php echo number_format($transaction->txn_amount, 2, ',', '.')?></td>
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