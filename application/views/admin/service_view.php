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
                           <h3>View Service</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                           <?php
                             foreach ($data as $service_detail) {
                           ?>
                           <form id="edit-profile" class="form-horizontal">
                              <fieldset>
                                 <div class="control-group">
                                    <label class="control-label" for="service_code">Service Code</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="service_code" name="service_code" value="<?=$service_detail->service_code?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="service_name">Service Name</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="service_name" name="service_name" value="<?=$service_detail->service_name?>" disabled="disabled">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="active">Active Status</label>
                                    <div class="controls">
                                       <?php if ($service_detail->active_status == 1) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Active" disabled="disabled">
                                       <?php } else if ($service_detail->active_status == 0) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Inactive" disabled="disabled">
                                       <?php } ?>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <br />
                                 <div class="form-actions">
                                    <a href="/Protech_BE/index.php/Controller_Service" class="btn">Back</a>
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