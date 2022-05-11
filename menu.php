<?php
$menu_active = '';
if (isset($_GET['menu'])) {
    $menu_active = $_GET['menu'];
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item active">
            <a href="index.php" class="nav-link <?php echo ($menu_active == '') ? "active" : ""; ?>">
            <i class="fas fa-home"></i>
              <p>Halaman Utama</p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="index.php?menu=data_transaksi" class="nav-link <?php echo ($menu_active == 'data_transaksi') ? "active" : ""; ?>">
            <i class="fas fa-table"></i>
              <p>Data Transaksi</p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="index.php?menu=proses_apriori" class="nav-link <?php echo ($menu_active == 'proses_apriori') ? "active" : ""; ?>">
            <i class="fab fa-first-order"></i>
              <p> Proses Apriori</p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="index.php?menu=hasil" class="nav-link <?php echo ($menu_active == 'hasil') ? "active" : ""; ?>">
            <i class="fas fa-clone"></i>
              <p>
               Hasil
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
              <p>
               Log out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>