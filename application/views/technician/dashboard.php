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
      <div class="content-wrapper">
      <div class="page-header">
         <h3 class="page-title">Basic Tables</h3>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Tables</a></li>
               <li class="breadcrumb-item active" aria-current="page"> Basic tables </li>
            </ol>
         </nav>
      </div>
      <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Order Need Confirmation</h4>
               </p>
               <div class="table-responsive">
                  <table class="table table-bordered data-table">
                     <thead>
                        <tr>
                           <th style="text-align: center">Order Code</th>
                           <th style="text-align: center">Fix Datetime</th>
                           <th style="text-align: center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $no=0;
                           foreach ($listNeedConfirm as $listNeedConfirm){
                           $no++;
                           ?>
                        <tr>
                           <td><?=$listNeedConfirm->order_code?></td>
                           <td><?=$listNeedConfirm->fix_datetime?></td>
                           <td style="text-align: center">
                              <a class="btn btn-info" href="/Protech_BE/index.php/Controller_Order/getOneByCode/<?=$listNeedConfirm->order_code?>" data-toggle="tooltip" title="View" style="padding: 4px">
                              <i class="mdi mdi-eye"></i>
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
      <div class="col-lg-6 grid-margin stretch-card">
      </div>
      <?php require 'application/views/footer.php'; ?>
   </body>
</html>