<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <?php if($this->session->userdata('akses')=='1') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Dashboard">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Admin">Admin</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Customer">Customer</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Technician">Technician</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Service">Service</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_FAQ">FAQ</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-coin menu-icon"></i>
                    <span class="menu-title">Transaction</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Order">Order</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_Payment">Payment</a>
                      </li>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-file menu-icon"></i>
                    <span class="menu-title">Report</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_IncomeReport">Income Report</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_DisbursementReport">Disbursement Report</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/Protech_BE/index.php/Controller_AuditLog">Audit Log</a>
                      </li>
                    </ul>
                  </div>
                </li>
              <?php } ?>
              <?php if($this->session->userdata('akses')=='2') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Dashboard">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Order/listOrderHistory">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    <span class="menu-title">Order</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Settings">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Settings</span>
                  </a>
                </li>
              <?php } ?>
              <?php if($this->session->userdata('akses')=='3') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Service">
                    <i class="mdi mdi-sitemap menu-icon"></i>
                    <span class="menu-title">Service</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Order/listOrderHistory">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    <span class="menu-title">Order</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Protech_BE/index.php/Controller_Settings">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Settings</span>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </nav>
      </div>
</body>
</html>