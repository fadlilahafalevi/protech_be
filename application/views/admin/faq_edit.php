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
                           <h3>Edit FAQ</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <br><br>
                           <?php
                             foreach ($data as $faq_detail) {
                           ?>
                           <form id="edit-faq" class="form-horizontal" method="post" action="<?php echo base_url() . 'Controller_FAQ/updateData'; ?>">
                              <fieldset>
                                 <div class="control-group" hidden>
                                    <label class="control-label" for="id">id</label>
                                    <div class="controls">
                                       <input type="text" class="span2" id="id" name="id" value="<?=$faq_detail->id?>" readonly>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="faq_question">Question</label>
                                    <div class="controls">
                                       <textarea type="text" class="span2" id="faq_question" name="faq_question"><?=$faq_detail->faq_question?></textarea>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <div class="control-group">
                                    <label class="control-label" for="faq_answer">Answer</label>
                                    <div class="controls">
                                       <textarea type="text" class="span2" id="faq_answer" name="faq_answer"><?=$faq_detail->faq_answer?></textarea>
                                    </div>
                                    <!-- /controls -->       
                                 </div>
                                 <!-- /control-group -->
                                 <br />
                                 <div class="form-actions">
                                     <button type="submit" class="btn btn-primary">Save</button> 
                                    <a href="/Protech_BE/index.php/Controller_FAQ" class="btn">Back</a>
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