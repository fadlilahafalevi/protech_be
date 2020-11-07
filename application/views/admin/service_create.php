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
                           <h3>Create Service</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                                    <form id="edit-profile" method="post" action="<?php echo base_url() . 'Controller_Service/saveData'; ?>" class="form-horizontal">
                                       <fieldset>
                                          <div class="control-group">
                                             <label class="control-label" for="service_name">Service Name</label>
                                             <div class="controls">
                                                <input type="text" class="span3" id="service_name" name="service_name">
                                             </div>
                                             <!-- /controls -->       
                                          </div>
                                          
                                          <br />
                                          <div class="form-actions">
                                             <button type="submit" class="btn btn-primary">Save</button> 
                                             <a href="/Protech_BE/index.php/Controller_Service" class="btn">Cancel</a>
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