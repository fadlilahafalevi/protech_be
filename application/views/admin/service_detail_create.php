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
                           <h3>View Service</h3>  <?= $error ?>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                           <form id="edit-profile" method="post" action="<?php echo base_url() . 'Controller_ServiceDetail/saveData'; ?>" enctype="multipart/form-data" class="form-horizontal">
                              <fieldset>
                                 <div class="control-group">
                                    <label class="control-label" for="service_code">Service</label>
                                    <div class="controls">
                                       <select class="form-control" id="service_code" name="service_code">
                                          <?php
                                            foreach($list_service as $list_service) { ?>
                                                <option value="<?= $list_service->service_code; ?>"><?= $list_service->service_code;?> - <?= $list_service->service_name;?></option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="service_detail_name">Service Detail Name</label>
                                    <div class="controls">
                                       <input type="text" class="span3" id="service_detail_name" name="service_detail_name">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="price">Price</label>
                                    <div class="controls">
                                       <span class="add-on">Rp.</span>
                                       <input type="text" class="span2" id="price" name="price">
                                       <span class="add-on">,00</span>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="icon">Icon</label>
                                    <div class="controls">
                                       <input type="file" class="span3" id="icon" name="icon">
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <br />
                                 <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="/Protech_BE/index.php/Controller_ServiceDetail" class="btn">Back</a>
                                 </div>
                                 <!-- /form-actions -->
                              </fieldset>
                           </form>
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