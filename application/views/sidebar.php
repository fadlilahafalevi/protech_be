<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/Protech_BE/index.php/Controller_Dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#master-data" aria-expanded="false" aria-controls="master-data">
        <i class="mdi mdi-database menu-icon"></i>
        <span class="menu-title">Master Data</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="master-data">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/Protech_BE/index.php/Controller_User">User</a></li>
          <li class="nav-item"> <a class="nav-link" href="/Protech_BE/index.php/Controller_UserRole">User Role</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Customer</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Technician</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Service</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#transactions" aria-expanded="false" aria-controls="transactions">
        <i class="mdi mdi-cash-multiple menu-icon"></i>
        <span class="menu-title">Transactions</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="transactions">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">New Order</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Processing Order</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Complete Order</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Reports</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="reports">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">Rating</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Complaint</a></li>
        </ul>
      </div>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#configurations" aria-expanded="false" aria-controls="configurations">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Configurations</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="configurations">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">Email Notification</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Contract</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Invoice</a></li>
        </ul>
      </div>
    </li>     -->      
  </ul>
</nav>
</body>
</html>