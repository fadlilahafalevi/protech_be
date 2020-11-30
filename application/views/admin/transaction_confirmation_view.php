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
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Wallet/confirmationSubmit'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="id">ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="id" name="id" value="<?=$transaction_detail->id?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$transaction_detail->phone?>" readonly>
                           </div>
                        </div>
                        <?php
                           if($transaction_detail->customer_name != null){
                         ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="customer_name">Customer Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?=$transaction_detail->customer_name?>" readonly>
                           </div>
                        </div>
                         <?php
                           } elseif($transaction_detail->tehcnician_name != null){
                         ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="tehcnician_name">Technician Name</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="tehcnician_name" name="tehcnician_name" value="<?=$transaction_detail->tehcnician_name?>" readonly>
                           </div>
                        </div>
                         <?php
                           }
                         ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_code">Transaction Type</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_code" name="txn_code" value="<?=$transaction_detail->txn_code?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_code">Order Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$transaction_detail->order_code?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_amount">Transaction Amount</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_amount" name="txn_amount" value="<?=$transaction_detail->txn_amount?>" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_datetime">Transaction Datetime</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="txn_datetime" name="txn_datetime" value="<?=$transaction_detail->txn_datetime?>" readonly>
                           </div>
                        </div>

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

						<?php if(isset($transaction_detail->receipt)) { ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="txn_datetime"></label>
                           <div class="col-sm-9">
                              <input type="radio" name="is_approved" id="choose-1" value="0"/>
                              <label for="choose-1">
                                 <img src="/Protech_BE/assets/images/reject.png" />
                              </label>

                              <input type="radio" name="is_approved" id="choose-2" value="1"/>
                              <label for="choose-2">
                                 <img src="/Protech_BE/assets/images/accept.png" />
                              </label>
                           </div>
                        </div>
                        <?php } ?>

                        <button type="submit" class="btn btn-primary">Submit</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Wallet">Back</a>
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