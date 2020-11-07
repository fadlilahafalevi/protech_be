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
                           <form id="edit-profile" method="post" action="<?php echo base_url() . 'Controller_ServiceDetail/updateData'; ?>" enctype="multipart/form-data" class="form-horizontal">
                              <fieldset>
                                 <div class="control-group">
                                    <label class="control-label" for="service_code">Service Code</label>
                                    <div class="controls">
                                       <select class="form-control" id="service_code" name="service_code">
                                    <?php
                                      foreach($list_service as $list_service) { 
                                        if($list_service->service_code == $service_detail->service_code) { ?>
                                          <option value="<?= $list_service->service_code; ?>" selected="true"><?= $list_service->service_code;?> - <?= $list_service->service_name;?></option>
                                        <?php } else { ?>
                                          <option value="<?= $list_service->service_code; ?>"><?= $list_service->service_code;?> - <?= $list_service->service_name;?></option>
                                    <?php
                                        }
                                      } 
                                    ?>
                                  </select>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="service_detail_code">Service Detail Code</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="service_detail_code" name="service_detail_code" value="<?=$service_detail->service_detail_code?>" readonly>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="service_detail_name">Service Detail Name</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="service_detail_name" name="service_detail_name" value="<?=$service_detail->service_detail_name?>" >
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="price">Price</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="price" name="price" value="<?=$service_detail->price?>" >
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="icon">Icon</label>
                                    <div class="controls">
                                       <img src="data:<?php echo $service_detail->img_icon; ?>;base64,<?php echo $service_detail->img_icon; ?>" width="75">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="active">Active Status</label>
                                    <div class="controls">
                                       <?php if ($service_detail->active_status == 1) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Active" >
                                       <?php } else if ($service_detail->active_status == 0) { ?>
                                       <input type="text" class="span3" id="active" name="active" value="Inactive" >
                                       <?php } ?>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <br />
                                 <div class="form-actions">
                                    <a href="/Protech_BE/index.php/Controller_ServiceDetail" class="btn">Back</a>
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