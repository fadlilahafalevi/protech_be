<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <?php
            if($this->session->userdata('akses')=='1' || $this->session->userdata('akses') == '2'){ //SUPERADMIN DAN ADMIN
          ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
              <?php
                if($this->session->userdata('akses')=='1'){ //SUPERADMIN
              ?>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_Admin">Admin</a></li>
              <?php
                }
              ?>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_Customer">Pelanggan</a></li>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_Technician">Teknisi</a></li>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_ServiceCategory">Kategori Layanan</a></li>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_ServiceType">Jenis Layanan</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_Complain">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Pengaduan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_ReportOrder"> Pemesanan </a></li>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_ReportPayment"> Pembayaran </a></li>
                <li class="nav-item"> <a class="nav-link" href="/teknisi-app/index.php/Controller_ReportRatingAndReview"> Penilaian dan Ulasan </a></li>
              </ul>
            </div>
          </li>
        <?php
          }
        ?> 



        <?php
          if($this->session->userdata('akses')=='3'){ //TEKNISI
        ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_Order/getAll/<?=$this->session->userdata('user_code')?>">
              <i class="mdi mdi-file menu-icon"></i>
              <span class="menu-title">Pemesanan</span>
            </a>
          </li>         
        <?php
          }
        ?> 



        <?php
          if($this->session->userdata('akses')=='4'){ //PELANGGAN
        ?>
          <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_DashboardCustomer">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>  
          <!-- <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_Technician">
              <i class="mdi mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Teknisi</span>
            </a>
          </li>  -->
          <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_Order/getAll/<?=$this->session->userdata('user_code')?>">
              <i class="mdi mdi-file menu-icon"></i>
              <span class="menu-title">Pemesanan</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-check menu-icon"></i>
              <span class="menu-title">Penilaian dan Ulasan</span>
            </a>
          </li>   
          <li class="nav-item">
            <a class="nav-link" href="/teknisi-app/index.php/Controller_Complain">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Pengaduan</span>
            </a>
          </li>         
        <?php
          }
        ?> 
        </ul>
      </nav>
</body>
</html>