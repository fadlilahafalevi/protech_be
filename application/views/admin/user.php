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
              <h3>User Master</h3>
              <a class="btn btn-invert" href="/Protech_BE/index.php/Controller_User/createUser">+</a>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Username</th>
                    <th style="text-align: center">Role</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no=0;
                    foreach ($list as $list_user){
                    $no++;
                  ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$list_user->username?></td>
                        <td><?=$list_user->role_name?></td>
                        <td style="text-align: center">
                          <?php
                            if($list_user->active_status == '1'){
                          ?>
                              <button disabled="disabled" class="btn btn-success">Active</button>
                          <?php
                            } elseif($list_user->active_status == '0'){
                          ?>
                              <button disabled="disabled" class="btn btn-danger">Inactive</button>
                          <?php
                            }
                          ?>
                        </td>
                        <td style="text-align: center">
                          <a class="btn btn-info" href="/Protech_BE/index.php/Controller_User/getOne/<?=$list_user->id?>" data-toggle="tooltip" title="View" style="padding: 4px">
                            <i class="icon-eye-open"></i>
                          </a>
                           <a class="btn btn-warning" href="/Protech_BE/index.php/Controller_User/updateUser/<?=$list_user->id?>" data-toggle="tooltip" title="Edit" style="padding: 4px">
                            <i class="icon-pencil"></i>
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