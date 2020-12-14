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
        <h3 class="page-title">Withdrawal</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Wallet/insertTransaction'; ?>">
                        <?php 
                         foreach ($data as $technician) {
                        ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">From Phone Number</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$technician->phone?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="balance">Balance</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="balance" name="balance" value="Rp. <?=$balance?>" readonly="readonly">
                           </div>
                        </div>
                        
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="bank_name">Bank Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="bank_name" name="bank_name">
                           </div>
                        </div>
                        
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="account_number">Account Number</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="account_number" name="account_number">
                           </div>
                        </div>
                        
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="account_name">Account Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="account_name" name="account_name">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="amount">Amount</label>
                           <div class="col-sm-9">
                              <input type="number" class="form-control" id="amount" name="amount" placeholder="0" min="10000" max="<?=$balance?>" />
                           </div>
                        </div>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="txn_code">Transaction Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_code" name="txn_code" value="WDRW" />
                           </div>
                        </div>

                        <?php } ?>

                        <?php if(isset($order_code)) { ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_code">Order Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$order_code?>" readonly="readonly" />
                           </div>
                        </div>
                        <?php } ?>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="is_processed">Is Processed</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="is_processed" name="is_processed" value="0" />
                           </div>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Next</button> 
                        <a class="btn btn-light" href="/protech/index.php/Controller_Dashboard">Back</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>