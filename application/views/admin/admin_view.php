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
        <h3 class="page-title">View Admin</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $admin_detail) {
                     ?>
                    <form class="forms-sample">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="admin_code">Admin Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="admin_code" name="admin_code" value="<?=$admin_detail->admin_code?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="email">Email</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="email" name="email" value="<?=$admin_detail->email?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="fullname">Fullname</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$admin_detail->fullname?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?=$admin_detail->phone?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="full_address">Full Address</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="full_address" name="full_address" disabled="disabled"><?=$admin_detail->full_address?></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="identity_number">Identity Number</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="identity_number" name="identity_number" value="<?=$admin_detail->identity_number?>" disabled="disabled">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="active">Active Status</label>
                           <div class="col-sm-9">
                              <?php if ($admin_detail->active_status == 1) { ?>
                                 <label class="badge badge-success">Active</label>
                              <?php } else if ($admin_detail->active_status == 0) { ?>
                                 <label class="badge badge-danger">Inactive</label>
                              <?php } ?>
                           </div>
                        </div>
                        <a class="btn btn-light" href="/protech/index.php/Controller_Admin">Back</a>
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