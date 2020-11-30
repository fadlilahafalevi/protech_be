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
        <h3 class="page-title">Edit FAQ</h3>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
               <h4 class="card-title"></h4>
                     <?php
                        foreach ($data as $faq_detail) {
                     ?>
                    <form class="forms-sample" method="post" action="<?php echo base_url() . 'Controller_FAQ/updateData'; ?>">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="faq_code">FAQ Code</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="faq_code" name="faq_code" value="<?=$faq_detail->faq_code?>" readonly="readonly">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="faq_question">Question</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="faq_question" name="faq_question"><?=$faq_detail->faq_question?></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label" for="faq_answer">Answer</label>
                           <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="faq_answer" name="faq_answer"><?=$faq_detail->faq_answer?></textarea>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button> 
                        <a class="btn btn-light" href="/Protech_BE/index.php/Controller_FAQ">Back</a>
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