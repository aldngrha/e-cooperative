@extends("layouts.app")

@section("title")
    E-Koperasi - Simpanan
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Simpanan {{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Nama Anggota</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $user->place_of_birth }}, {{ \Carbon\Carbon::parse($user->date_of_birth)->isoFormat("D MMMM YYYY") }}</td>
                        </tr>
                        <tr>
                            <th class="text-primary">Total Simpanan Pokok</th>
                            <td class="text-primary">Rp {{ number_format($showSum,0,".",".") }}</td>
                        </tr>
                        <tr>
                            <th class="text-primary">Total Simpanan Wajib</th>
                            <td class="text-primary">Rp {{ number_format($showSumMust,0,".",".") }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
