<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
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
                if($this->session->userdata('akses')=='1'){
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
                <li class="nav-item"> <a class="nav-link" href="#"> Pemesanan </a></li>
                <li class="nav-item"> <a class="nav-link" href="#"> Pembayaran </a></li>
                <li class="nav-item"> <a class="nav-link" href="#"> Penilaian dan Ulasan </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
</body>
</html>