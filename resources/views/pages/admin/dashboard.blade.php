@extends("layouts.admin.admin")

@section("title")
  Dashboard Admin Koperasi
@endsection

@section("content")
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Saldo Koperasi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total,0,".",".") }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-wallet fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Total Simpanan Pokok</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($deposit,0,".",".") }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Simpanan Wajib
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                        Rp {{ number_format($deposit_must,0,".",".") }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Total Pinjaman Anggota</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_loan,0,".",".") }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->

    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">5 Pinjaman Terakhir</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Waktu Pengajuan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
{{--                        @forelse($users as $user)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $user->name }}</td>--}}
{{--                                <td>{{ $user->name }}</td>--}}
{{--                                <td>{{ $user->name }}</td>--}}
{{--                                <td>{{ $user->loans->status }}</td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td class="text-center" colspan="6">--}}
{{--                                    Data tidak tersedia--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Cart Peminjaman</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
              <span class="mr-2">
                  <i class="fas fa-circle text-secondary"></i> TERTUNDA
              </span>
              <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> LUNAS
              </span>
              <span class="mr-2">
                  <i class="fas fa-circle text-warning"></i> BELUM LUNAS
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
@endsection

@push("after-script")
    <script>
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["TERTUNDA", "LUNAS", "BELUM LUNAS"],
                datasets: [{
                    data: [{{ $pie["tertunda"] }}, {{ $pie["lunas"] }}, {{ $pie["belum_lunas"] }}],
                    backgroundColor: ['#ffc107', '#42ba96', '#6c757d'],
                    hoverBackgroundColor: ['#d19b01', '#2f8d70', '#474e53'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endpush

