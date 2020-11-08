<!DOCTYPE html>
<html>
<head>
  <title></title>
<link href="/Protech_BE/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/Protech_BE/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="/Protech_BE/assets/css/font-awesome.css" rel="stylesheet">
<link href="/Protech_BE/assets/css/style.css" rel="stylesheet">
<link href="/Protech_BE/assets/css/pages/dashboard.css" rel="stylesheet">
</head>
<body>
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">PROTECH </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?=$this->session->userdata('fullname');?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="javascript:;">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
  </div>
</body>
<script src="/Protech_BE/assets/js/jquery-1.7.2.min.js"></script> 
<script src="/Protech_BE/assets/js/excanvas.min.js"></script> 
<script src="/Protech_BE/assets/js/chart.min.js" type="text/javascript"></script> 
<script src="/Protech_BE/assets/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="/Protech_BE/assets/js/full-calendar/fullcalendar.min.js"></script>
<script src="/Protech_BE/assets/js/base.js"></script>
</html>