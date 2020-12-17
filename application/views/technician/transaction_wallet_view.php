<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>PROTECH</title>
   <style type="text/css">
      
      img {
        width: 20vw;
        height: 20vw;
        padding: 2vw;
      }

      input[type=radio] {
        display: none;
      }

      img:hover {
        opacity:0.6;
        cursor: pointer;
      }

      img:active {
        opacity:0.4;
        cursor: pointer;
      }

      input[type=radio]:checked + label > img {
        border: 20px solid rgb(0, 51, 196);
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
        <h3 class="page-title">View Transaction</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $transaction_detail) {
                     ?>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Wallet/confirmationSubmit'; ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="id">ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="id" name="id" value="<?=$transaction_detail->id?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                           <?php if($transaction_detail->txn_code == 'TOPU') { ?>
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$transaction_detail->to_phone?>" readonly>
                           <?php } elseif($transaction_detail->txn_code == 'WDRW') { ?>
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$transaction_detail->from_phone?>" readonly>
                           <?php } ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="transaction_code">Transaction Type</label>
                           <div class="col-sm-9">
							<?php if ($transaction_detail->txn_code == 'TOPU') {?>
                              <input type="text" class="form-control" id="transaction_code" name="transaction_code" value="TOP UP" readonly>
							<?php } elseif($transaction_detail->txn_code == 'WDRW') { ?>
							  <input type="text" class="form-control" id="transaction_code" name="transaction_code" value="WITHDRAWAL" readonly>
							<?php } ?>
                           </div>
                        </div>
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="txn_code">Transaction Type</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_code" name="txn_code" value="<?=$transaction_detail->txn_code?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="name_from">From</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="name_from" name="name_from" value="<?=$transaction_detail->NAME_FROM?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="name_to">To</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="name_to" name="name_from" value="<?=$transaction_detail->NAME_TO?>" readonly>
                           </div>
                        </div>
                        <?php if($transaction_detail->order_code != null) {?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_code">Order Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$transaction_detail->order_code?>" readonly>
                           </div>
                        </div>
                        <?php }?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_amount">Transaction Amount</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_amount" name="txn_amount" value="Rp. <?php echo number_format($transaction_detail->txn_amount,2,',','.') ?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_datetime">Transaction Datetime</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_datetime" name="txn_datetime" value="<?=$transaction_detail->txn_datetime?>" readonly>
                           </div>
                        </div>
                        
						<?php if(isset($transaction_detail->additional_info)) { ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_datetime">Reason</label>
                           <div class="col-sm-9">
                            
                              <input type="text" class="form-control" id="txn_datetime" name="txn_datetime" value="<?=$transaction_detail->additional_info?>" readonly>
                            
                           </div>
                        </div>
                        <?php } ?>

                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_datetime">Receipt</label>
                           <div class="col-sm-9">
                            <?php if(isset($transaction_detail->receipt)) { ?>
                              <img src="data:image/jpg;base64,<?php echo $transaction_detail->receipt; ?>" width="50%">
                            <?php } else { ?>
                              <label for="not_uploaded">Receipt not yet uploaded.</label>
                            <?php } ?>
                           </div>
                        </div>
                        <a class="btn btn-light" href="/protech/index.php/Controller_Wallet/getTransactionByPhone/<?=$this->session->userdata('phone')?>">Back</a>
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
</body>
</html>