<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>PROTECH</title>
   <style>    
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
          <a class="btn btn-primary" href="/protech/index.php/Controller_Order/getWaitingConfirmationOrder?>">Back Order List</a>
          <a class="btn btn-danger" href="/protech/index.php/Controller_Order/rejectByAdmin/<?=$order_code?>">Reject</a>
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