<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-wallet"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E-KOPERASI</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route("dashboard") }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    User
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ request()->is('admin/member*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="{{ route("member.index") }}">
      <i class="fas fa-fw fa-users"></i>
      <span>Anggota</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Transaksi
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ request()->is('admin/saving*', "admin/saving-must*") ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
       aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-wallet"></i>
      <span>Pengajuan Simpanan</span>
    </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Simpanan</h6>
              <a class="collapse-item" href="{{ route("saving.index") }}">Simpanan Pokok</a>
              <a class="collapse-item" href="{{ route("saving-voluntary.index") }}">Simpanan Sukarela</a>
              <a class="collapse-item" href="{{ route("saving-must.index") }}">Simpanan Wajib</a>
          </div>
      </div>
  </li>
  <!-- Nav Item - Charts -->
  <li class="nav-item {{ request()->is('admin/loan*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="{{ route("loan.index") }}">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Pengajuan Pinjaman</span>
    </a>
  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Angsuran</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Modal Koperasi</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Pengeluaran</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Sisa Hasil Usaha (SHU)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Laporan</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Option
    </div>

    <li class="nav-item {{ request()->is('admin/option*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route("option.index") }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Opsi</span></a>
    </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->
