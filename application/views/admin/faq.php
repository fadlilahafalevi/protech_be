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
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>FAQ Master</h3>
              <a class="btn btn-invert" href="/Protech_BE/index.php/Controller_FAQ/createFAQ">+</a>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
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
                              <td><?=$list_faq->faq_question?></td>
                              <td><?=$list_faq->faq_answer?></td>
                              <td style="text-align: center">
                                 <a class="btn btn-info" href="/Protech_BE/index.php/Controller_FAQ/getOne/<?=$list_faq->id?>" data-toggle="tooltip" title="View" style="padding: 4px">
                                  <i class="icon-eye-open"></i>
                                </a>
                                 <a class="btn btn-warning" href="/Protech_BE/index.php/Controller_FAQ/updateFAQ/<?=$list_faq->id?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                                  <i class="icon-pencil"></i>
                                </a>
                                 <a class="btn btn-danger" href="/Protech_BE/index.php/Controller_FAQ/deleteFAQ/<?=$list_faq->id?>" data-toggle="tooltip" title="Delete" style="padding: 4px">
                                  <i class="icon-trash"></i>
                                </a>
                              </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
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