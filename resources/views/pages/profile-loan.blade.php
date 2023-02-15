@extends("layouts.app")

@section("title")
    E-Koperasi - Pinjaman
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Pinjaman {{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Kode Anggota</th>
                            <td>{{ $user->member_number }}</td>
                        </tr>
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
                            <th>Nomor Handphone</th>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $user->position }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Jatuh Tempo</th>
                            <td>{{ $due_date }}</td>
                        </tr>
                        <tr>
                            <th class="text-primary font-weight-light">Total Pinjaman</th>
                            <td class="text-primary">
                                Rp {{ number_format($total,0,".",".") }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-primary font-weight-light">Bunga ({{ $option->interest_rate }}%)</th>
                            <td class="text-primary">Rp {{ number_format($rate,0,".",".") }}</td>
                        </tr>
                        <tr>
                            <th class="text-primary">Total Bayar</th>
                            <td class="text-primary font-weight-bold">Rp {{ number_format($total_rate,0,".",".") }}</td>
                        </tr>
                        <tr>
                            <th class="text-primary">Angsuran perbulan (selama {{ $option->time_period }} bulan)</th>
                            <td class="text-primary font-weight-bold">Rp {{ number_format($result,0,".",".") }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
