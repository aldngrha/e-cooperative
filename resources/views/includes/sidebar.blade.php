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
  <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
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
  <li class="nav-item {{ request()->is('deposit', "deposit-must") ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
       aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-wallet"></i>
      <span>Pengajuan Simpanan</span>
    </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Simpanan</h6>
              <a class="collapse-item" href="{{ route("deposit") }}">Simpanan Sukarela</a>
              <a class="collapse-item" href="{{ route("deposit-must") }}">Simpanan Wajib</a>
          </div>
      </div>
  </li>
  <!-- Nav Item - Charts -->
  <li class="nav-item {{ request()->is('loan') ? 'active' : '' }} ">
    <a class="nav-link collapsed" href="{{ route("loan") }}" >
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Pengajuan Pinjaman</span>
    </a>

  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item {{ request()->is('installment') ? 'active' : '' }}">
    <a class="nav-link" href="{{route("installment")}}">
      <i class="fas fa-fw fa-money-bill-wave"></i>
      <span>Angsuran</span></a>
  </li>
  <li class="nav-item {{ request()->is('surplus') ? 'active' : '' }}">
    <a class="nav-link" href="{{route("surplus")}}">
      <i class="fas fa-fw fa-money-bill"></i>
      <span>Penarikan Sisa Hasil Usaha</span></a>
  </li>
  <li class="nav-item {{ request()->is('cash-flow', 'withdraw') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report"
       aria-expanded="true" aria-controls="report">
        <i class="fas fa-fw fa-file"></i>
        <span>Laporan</span>
    </a>
    <div id="report" class="collapse" aria-labelledby="report" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan</h6>
            <a class="collapse-item" href="{{ route("cash-flow") }}">Laporan Arus Kas</a>
            <a class="collapse-item" href="{{ route("withdraws") }}">Laporan Sisa Hasil Usaha</a>
        </div>
    </div>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->
