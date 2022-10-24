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
  <li class="nav-item active">
    <a class="nav-link" href="{{ route("home") }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Transaksi
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
       aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-wallet"></i>
      <span>Pengajuan Simpanan</span>
    </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Simpanan</h6>
              <a class="collapse-item" href="{{ route("deposit") }}">Simpanan Pokok</a>
              <a class="collapse-item" href="{{ route("deposit-must") }}">Simpanan Wajib</a>
          </div>
      </div>
  </li>
  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route("loan") }}" >
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Pengajuan Pinjaman</span>
    </a>

  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="{{url("backend/tables.html")}}">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>Laporan</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->
