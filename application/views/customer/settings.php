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
        <h3 class="page-title">Settings</h3>
        <a class="btn btn-success" href="/Protech_BE/index.php/Controller_Settings/updateProfile">Update Profile</a>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $user_detail) {
                     ?>
                    <form class="forms-sample">
                        <div class="form-group row" hidden>
                           <label class="col-sm-3 col-form-label" for="id">ID</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="id" name="id" value="<?=$user_detail->id?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="email">Email</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="email" name="email" value="<?=$user_detail->email?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fullname">Fullname</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$user_detail->fullname?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$user_detail->phone?>" readonly="readonly">
                           </div>
                        </div>
                        <?php if ($this->session->userdata('akses')=='2') { ?>
                          <div class="form-group row">
                             <label class="col-sm-3 col-form-label" for="identity_number">Identity Number</label>
                             <div class="col-sm-9">
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="<?=$user_detail->identity_number?>" readonly="readonly">
                             </div>
                          </div>
                          <div class="form-group row">
                             <label class="col-sm-3 col-form-label" for="bank_account_number">Bank Account Number</label>
                             <div class="col-sm-9">
                                <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="<?=$user_detail->bank_account_number?>" readonly="readonly">
                             </div>
                          </div>
                        <?php } ?>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Full Address</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="full_address" name="full_address" readonly="readonly"><?=$user_detail->full_address?></textarea>
                           </div>
                        </div>
                        <br/>
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