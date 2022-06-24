<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Adm-SPP</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('Dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menumaster" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-archive"></i>
        <span>Master Data</span>
      </a>
      <div id="menumaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= base_url('DataTPQ'); ?>">Data TPQ</a>
          <a class="collapse-item" href="<?= base_url('Guru'); ?>">Guru</a>
          <a class="collapse-item" href="<?= base_url('PesertaDidik'); ?>">Peserta Didik</a>
          <a class="collapse-item" href="<?= base_url('Kategori'); ?>">Kategori</a>
        </div>
      </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menutransaksi" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Transaksi</span>
      </a>
      <div id="menutransaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url('Bayar'); ?>">Bayar</a>
          <a class="collapse-item" href="<?= base_url('Income'); ?>">Income</a>
          <a class="collapse-item" href="<?= base_url('Outcome'); ?>">Outcome</a>
        </div>
      </div>
    </li>
    
</ul>
    <!-- End of Sidebar -->