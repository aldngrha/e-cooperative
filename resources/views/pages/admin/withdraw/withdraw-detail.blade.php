@extends("layouts.admin.admin")

@section("title")
    Detail Angsuran - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Angsuran {{ $users->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" width="100%" cellspacing="0">
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
                <h1 class="h3 mb-2 text-primary font-weight-bold">List Penarikan {{ $users->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Penarikan</th>
                            <th>Nama Anggota</th>
                            <th>Waktu Pengajuan</th>
                            <th>Jumlah Penarikan</th>
                            <th>Nominal yang diterima</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->surplus_code }}</td>
                                <td>{{ $user->members->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>Rp {{ number_format($user->amount_withdraw,0,".",".") }}</td>
                                <td>Rp {{ number_format($user->amount_withdraw * 0.7,0,".",".") }}</td>
                                <td>
                                    @if ($user->status == "PENDING")
                                        <span class="p-2 badge badge-secondary">
                                    @elseif ($user->status == "ACCEPT")
                                        <span class="p-2 badge badge-success">
                                    @elseif ($user->status == "DECLINE")
                                        <span class="p-2 badge badge-danger">
                                    @endif
                                            {{ $user->status }}
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
