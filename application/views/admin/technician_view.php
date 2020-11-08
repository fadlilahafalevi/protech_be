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
      <div class="main">
         <div class="main-inner">
            <div class="container">
               <div class="row">
                  <div class="span12">
                     <div class="widget widget-table action-table">
                        <div class="widget-header">
                           <i class="icon-th-list"></i>
                           <h3>View Technician</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                           <?php
                             foreach ($data as $technician_detail) {
                           ?>
                           <form id="edit-profile" class="form-horizontal">
                              <fieldset>
                                 <div class="control-group">
                                    <label class="control-label" for="email">Email</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="email" name="email" value="<?=$technician_detail->email?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="fullname">Fullname</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="fullname" name="fullname" value="<?=$technician_detail->fullname?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="phone">Phone</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="phone" name="phone" value="<?=$technician_detail->phone?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="full_address">Full Address</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="full_address" name="full_address" value="<?=$technician_detail->full_address?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <div class="control-group">
                                    <label class="control-label" for="identity_number">Identity Number</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="identity_number" name="identity_number" value="<?=$technician_detail->identity_number?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="bank_account_number">Bank Account Number</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="bank_account_number" name="bank_account_number" value="<?=$technician_detail->bank_account_number?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <div class="control-group">
                                    <label class="control-label" for="active">Active Status</label>
                                    <div class="controls">
                                       <?php if ($technician_detail->active_status == 1) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Active" disabled="disabled">
                                       <?php } else if ($technician_detail->active_status == 0) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Inactive" disabled="disabled">
                                       <?php } ?>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <br />
                                 <div class="form-actions">
                                    <a href="/Protech_BE/index.php/Controller_Technician" class="btn">Back</a>
                                 </div>
                                 <!-- /form-actions -->
                              </fieldset>
                           </form>
                              <?php
                             }
                           ?>
                        </div>
                        <!-- /widget-content --> 
                     </div>
                  </div>
                  <!-- /span6 --> 
               </div>
               <!-- /row --> 
            </div>
            <!-- /container --> 
         </div>
         <!-- /main-inner --> 
      </div>
      <?php require 'application/views/extra.php'; ?>
      <?php require 'application/views/footer.php'; ?>
   </body>
</html>