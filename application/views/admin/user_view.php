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
                           <h3>View User</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                           <?php
                             foreach ($data as $user_detail) {
                           ?>
                           <form id="edit-profile" class="form-horizontal">
                              <fieldset>
                                 <div class="control-group">
                                    <label class="control-label" for="usercode">User Code</label>
                                    <div class="controls">
                                       <input type="text" class="span2" id="usercode" name="usercode" value="<?=$user_detail->user_code?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="username">Username</label>
                                    <div class="controls">
                                       <input type="text" class="span2" id="username" name="username" value="<?=$user_detail->username?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="fullname">Full Name</label>
                                    <div class="controls">
                                       <input type="text" class="span2" id="fullname" name="fullname" value="<?=$user_detail->fullname?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="role">Role</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="role" name="role" value="<?=$user_detail->role_name?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <div class="control-group">
                                    <label class="control-label" for="email">Email Address</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="email" name="email" value="<?=$user_detail->email?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <div class="control-group">
                                    <label class="control-label" for="active">Active Status</label>
                                    <div class="controls">
                                       <?php if ($user_detail->active_status == 1) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Active" disabled="disabled">
                                       <?php } else if ($user_detail->active_status == 0) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Inactive" disabled="disabled">
                                       <?php } ?>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <br />
                                 <div class="form-actions">
                                    <a href="/Protech_BE/index.php/Controller_User" class="btn">Back</a>
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