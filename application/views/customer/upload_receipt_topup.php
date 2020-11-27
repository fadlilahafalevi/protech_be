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
        <h3 class="page-title">Order Detail</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Wallet/uploadReceipt'; ?>" enctype="multipart/form-data">
                        <?php 
                         foreach ($insertedData as $data) {
                        ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="amount">Amount</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="amount" name="amount" value="<?=$data->txn_amount?>" readonly="readonly">
                           </div>
                        </div>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="id">ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="id" name="id" value="<?=$data->id?>" readonly="readonly">
                           </div>
                        </div>

                        <?php } ?>

                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="receipt">Receipt</label>
                           <div class="col-sm-9">
                              <input type="file" class="span3" id="receipt" name="receipt"/>
                           </div>
                        </div>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$phone?>" />
                           </div>
                        </div>

                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="is_processed">Is Processed</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="is_processed" name="is_processed" value="0" />
                           </div>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Next</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_Dashboard">Back</a>
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