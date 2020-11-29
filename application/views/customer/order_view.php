<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>PROTECH</title>
   <style>
      #map {
        width: 100%;
        height: 300px;
        border: 1px solid #000;
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
         <?php
            foreach ($data as $order) {
         ?>
        <h3 class="page-title">Order <?=$order->order_code?></h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/Protech_BE/index.php/Controller_Order/getAllByCustomerCode/<?=$this->session->userdata('code')?>">Back to Order History</a>
        </div>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/inputOrder'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="order_code">Order Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_code" name="order_code" value="<?=$order->order_code?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="address">Address</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="address" name="address" value="<?=$order->address?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fix_datetime">Fix Datetime</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fix_datetime" name="fix_datetime" value="<?=$order->fix_datetime?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="technician_name">Technician</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="technician_name" name="technician_name" value="<?=$order->technician_name?>" readonly="readonly">
                           </div>
                        </div>
                        <?php if ($order->order_status == 'WAITING PAYMENT') { ?>

                        <div class="form-group row">
                           <label class="col-sm-8 col-form-label" for="notif-topup">You must top up your balance at least <mark> Rp. <?=$total_price?> </mark> before proceeding with the order.</label>
                           <div class="col-sm-2">
                              <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Wallet/customTopUpOrder/<?=$order->order_code?>/<?=$price?>">Top Up</a>
                           </div>
                           <label class="col-sm-8 col-form-label">After Top Up, your balance will automatically paid to order.</label>
                        </div>

                        <div class="form-group row">
                           
                        </div>

                        <div class="form-group row">
                           <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Order/customTopUp/<?=$this->session->userdata('code')?>/<?=$total_price?>">Top Up</a>
                        </div>
                        <?php } ?>
                     </form>

                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="content-wrapper pb-0">
         <div class="page-header"> 
         <h3 class="page-title">DETAIL SERVICE</h3>
         </div>
            <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
               <div class="card-body">
                 <div class="table-responsive pt-3">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th style="text-align: center">No</th>
                         <th style="text-align: center">Service Type Code</th>
                         <th style="text-align: center">Service Type Name</th>
                         <th style="text-align: center">Price</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php 
                         $no=0;
                         foreach ($detail as $detail){
                         $no++;
                       ?>
                         <tr>
                             <td><?=$no?></td>
                             <td><?=$detail->service_type_code?></td>
                             <td><?=$detail->service?></td>
                             <td><?=$detail->price?></td>
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