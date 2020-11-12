<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PROTECH</title>
  <style type="text/css">
    .ellipsis {
        max-width: 100px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
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
        <h3 class="page-title">Master Frequently Asked Questions</h3>
        <a class="btn btn-success" href="/Protech_BE/index.php/Controller_FAQ/createFAQ">Create</a>
      </div>
      <!-- first row starts here -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-3">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">ID</th>
                      <th style="text-align: center">Question</th>
                      <th style="text-align: center">Answer</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($data as $list_faq){
                      $no++;
                    ?>
                      <tr>
                          <td><?=$no?></td>
                          <td class="ellipsis"><?=$list_faq->faq_question?></td>
                          <td class="ellipsis"><?=$list_faq->faq_answer?></td>
                          <td style="text-align: center">
                            <a class="btn btn-info" href="/Protech_BE/index.php/Controller_FAQ/getOne/<?=$list_faq->id?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
                            </a>
                             <a class="btn btn-warning" href="/Protech_BE/index.php/Controller_FAQ/updateFAQ/<?=$list_faq->id?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                              <i class="mdi mdi-pencil"></i>
                            </a>
                            <a class="btn btn-danger" href="/Protech_BE/index.php/Controller_FAQ/deleteFAQ/<?=$list_faq->id?>" data-toggle="tooltip" title="Delete" style="padding: 4px">
                              <i class="mdi mdi-close "></i>
                            </a>
                          </td>
                      </tr>
                    <?php
                    }
                    ?>        
                  </tbody>
                </table>
              </div>
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