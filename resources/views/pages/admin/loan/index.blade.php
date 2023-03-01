@extends("layouts.admin.admin")

@section("title")
    Pengajuan Pinjaman - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Tabel Pinjaman</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pinjam</th>
                            <th>Nama Anggota</th>
                            <th>Waktu Pengajuan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Total Pengembalian</th>
                            <th>Batas Waktu</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                <td>
                                    <a href="{{ route('loan.show', $item->members->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('loan.edit', $item->id) }}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
{{--                                    <form action="{{ route('option.destroy', $item->id) }}" class="d-inline" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}
{{--                                        <button class="btn btn-danger">--}}
{{--                                            <i class="fas fa-trash"></i>--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
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
                <div class="my-3">
                    <h4 class="h5">Cetak Data Pinjaman</h4>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="input-group align-items-center">
                            <label for="firstDate" class="mr-2">Tanggal Awal</label>
                            <input type="date" name="firstDate" id="firstDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="input-group align-items-center">
                            <label for="lastDate" class="mr-2">Tanggal Akhir</label>
                            <input type="date" name="lastDate" id="lastDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="#" onclick="printSaving()" target="_blank" class="btn btn-primary d-block"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

<script>
    function printSaving() {
        const firstDate = document.getElementById("firstDate").value;
        const lastDate = document.getElementById("lastDate").value;

        const url = "{{ route('print-loan', [ 'firstDate' => ':firstDate', 'lastDate' => ':lastDate' ]) }}"
            .replace(':firstDate', firstDate)
            .replace(':lastDate', lastDate);

        window.open(url, '_blank');
    }
</script>
