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
                <h1 class="h3 mb-2 text-primary font-weight-bold">Identitas {{ $users->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Kode Anggota</th>
                            <td>{{ $users->member_number }}</td>
                        </tr>
                        <tr>
                            <th>Nama Anggota</th>
                            <td>{{ $users->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $users->email }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $users->place_of_birth }}, {{ \Carbon\Carbon::parse($users->date_of_birth)->isoFormat("D MMMM YYYY") }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Handphone</th>
                            <td>{{ $users->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $users->position }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $users->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">List Pinjaman {{ $users->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pinjaman</th>
                            <th>Nama Anggota</th>
                            <th>Waktu Pengajuan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Total Pengembalian</th>
                            <th>Batas Waktu</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->loan_code }}</td>
                                <td>{{ $item->members->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>Rp {{ number_format($item->amount_loan,0,".",".") }}</td>
                                <td>Rp {{ number_format(($item->amount_loan * $item->options->interest_rate) / 100 + $item->amount_loan,0,".",".") }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->due_date)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>
                                    @if ($item->status == "TERTUNDA")
                                        <span class="p-2 badge badge-secondary">
                                        @elseif ($item->status == "BELUM LUNAS")
                                                <span class="p-2 badge badge-warning">
                                        @elseif ($item->status == "LUNAS")
                                                        <span class="p-2 badge badge-success">
                                        @elseif ($item->status == "GAGAL")
                                                                <span class="p-2 badge badge-danger">
                                        @endif
                                                                    {{ $item->status }}
                                            </span>
                                            </span>
                                            </span>
                                            </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data kosong
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
