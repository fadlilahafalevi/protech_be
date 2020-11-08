<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - Bootstrap Admin Template</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="/Protech_BE/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/Protech_BE/assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="/Protech_BE/assets/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="/Protech_BE/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="/Protech_BE/assets/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="account-container">
  
  <!-- <div class="content clearfix"> -->
    <center>
    <img src="/Protech_BE/assets/img/protech-logo.png" style="height: 50%; width: 50%;">
    </center>
  <!-- </div> -->

  <div class="content clearfix">
    
    <form action="<?php echo base_url() . 'Controller_Login/cekuser' ?>" method="post">
    
      <h1>SIGN IN</h1>   
        <div class="login-fields">
          
          <p>Please provide your details</p>
          
          <div class="field">
            <label for="email">Email</label>
            <input type="text" id="email" name="username" value="" placeholder="Email" class="login username-field" />
          </div> <!-- /field -->
          
          <div class="field">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
          </div> <!-- /password -->
          
        </div> <!-- /login-fields -->
        <p align="center" style="color: red"><?php echo $this->session->flashdata('msg'); ?></p>
      
        <div class="login-actions">
          <button class="button btn btn-primary btn-large">Sign In</button>
        </div> <!-- .actions -->
      </form>
    
  </div> <!-- /content -->
  
</div> <!-- /account-container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
