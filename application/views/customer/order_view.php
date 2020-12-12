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
    
    img {
        width: 10vw;
        height: 10vw;
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
    
    .rating {
    	position: absolute;
    	left: 25%;
    	transform: translate(-50%, -50%) rotateY(180deg);
    	display: flex;
    }
    
    .rating input {
    	display: none;
    }
    
    .rating label {
    	display: block;
    	cursor: pointer;
    	width: 50px;
    }
    
    .rating label:before {
    	content: '\f005';
    	font-family: fontAwesome;
    	position: relative;
    	display: block;
    	font-size: 50px;
    	color: #101010;
    }
    
    .rating label:after {
    	content: '\f005';
    	font-family: fontAwesome;
    	position: absolute;
    	display: block;
    	font-size: 50px;
    	color: #fffa00;
    	top: 0;
    	opacity: 0;
    	transition: .5s;
    	text-shadow: 0 2px 5px rgba(0, 0, 0, .5);
    }
    
    .rating label:hover:after, .rating label:hover ~ label:after, .rating input:checked 
    	~ label:after {
    	opacity: 1;
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
                $order_status = $order->order_status;
                $order_code = $order->order_code;
                $order_rate = $order->order_rate;
         ?>
        <h3 class="page-title">Order <?=$order->order_code?></h3>
        <div class="template-demo">
          <a class="btn btn-primary" href="/protech/index.php/Controller_Order/getAllByCustomerCode/<?=$this->session->userdata('code')?>">Back to Order History</a>
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
                           <label class="col-sm-3 col-form-label" for="order_status">Order Status</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="order_status" name="order_status" value="<?=$order->order_status?>" readonly="readonly">
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
                              <a class="btn btn-success" href="/protech/index.php/Controller_Wallet/customTopUpOrder/<?=$order->order_code?>/<?=$price?>">Top Up</a>
                           </div>
                           <label class="col-sm-8 col-form-label">After Top Up, your balance will automatically paid to order.</label>
                        </div>

                        <div class="form-group row">
                           
                        </div>

                        <div class="form-group row">
                           <a class="btn btn-success" href="/protech/index.php/Controller_Order/customTopUp/<?=$this->session->userdata('code')?>/<?=$total_price?>">Top Up</a>
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
                         $isPaidCounter=0;
                         foreach ($detail as $detail){
                         $no++;
                         if($detail->is_paid == 0) {
                             $isPaidCounter++;
                         }
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
                 <br><br><br>
                 <?php if ($isPaidCounter > 0 && $order_status == 'IN PROGRESS') {?>
				<form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/approvedRequestByCustomer/'.$order_code.'/'.$this->session->userdata('phone'); ?>">
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Approve New Request?</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <input type="radio" name="is_approved" id="choose-1" value="0"/>
                        <label for="choose-1">
                        	<img src="/protech/assets/images/reject.png" />
                        </label>
                        
                        <input type="radio" name="is_approved" id="choose-2" value="1"/>
                        <label for="choose-2">
                        	<img src="/protech/assets/images/accept.png" />
                        </label>
                    </div>
                </div>
				<button type="submit" class="btn btn-success">Submit</button>
				</form>
                 <?php } elseif ($order_status == 'FINISHED' && $order_rate == null) { ?>
                 Order Rating : 
                 <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_Order/submitRating/'.$order_code; ?>">
                 	<div class="rating">
                		<input type="radio" name="rate" id="star1" value="5"><label for="star1"></label>
                		<input type="radio" name="rate" id="star2" value="4"><label for="star2"></label>
                		<input type="radio" name="rate" id="star3" value="3"><label for="star3"></label>
                		<input type="radio" name="rate" id="star4" value="2"><label for="star4"></label>
                		<input type="radio" name="rate" id="star5" value="1"><label for="star5"></label>
                	</div>
                	<br>
                	<br>
                	<br>
                	<button type="submit" class="btn btn-success">Submit Rating</button>
                </form>
                <?php } ?>
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