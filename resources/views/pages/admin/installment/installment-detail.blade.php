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
                <h1 class="h3 mb-2 text-primary font-weight-bold">List Angsuran {{ $users->name }}</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pinjaman</th>
                            <th>Nama Anggota</th>
                            <th>Angsuran Ke</th>
                            <th>Pembayaran Angsuran</th>
                            <th>Bunga Angsuran</th>
                            <th>Waktu Pengajuan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users->loans as $loan)
                            @foreach ($loan->installments as $installment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->loan_code }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $installment->installment_number }}</td>
                                    <td>Rp {{ number_format($installment->amount_installment,0,".",".") }}</td>
                                    <td>Rp {{ number_format($installment->interest_rate,0,".",".") }}</td>
                                    <td>{{ \Carbon\Carbon::parse($installment->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                </tr>
                            @endforeach
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
