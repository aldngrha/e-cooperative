<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
        <img class="img-profile rounded-circle" alt="Avatar {{ Auth::user()->name }}"
             src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
           aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route("edit") }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profil Anggota
        </a>
          <a class="dropdown-item" href="{{ route("saving") }}">
              <i class="fas fa-wallet fa-sm fa-fw mr-2 text-gray-400"></i>
              Tabungan
          </a>
          <a class="dropdown-item" href="{{ route("profile-loan") }}">
              <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-gray-400"></i>
              Pinjaman
          </a>
          <a class="dropdown-item" href="{{ route("profile-installment") }}">
              <i class="fas fa-money-bill-wave fa-sm fa-fw mr-2 text-gray-400"></i>
              Angsuran
          </a>
          <a class="dropdown-item" href="{{ route("profile-withdraw") }}">
              <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
              Penarikan
          </a>
          <a class="dropdown-item" href="{{ route("password-edit") }}">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="dropdown-item" type="submit">
              <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
              Logout
            </button>
          </form>
        </a>
      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->
