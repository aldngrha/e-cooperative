@extends("layouts.admin.admin")

@section("title")
    Angsuran - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session()->has("message"))
            <div class="alert alert-success">
                <p>{{  session()->get("message") }}</p>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="h3 mb-2 text-primary font-weight-bold">Tabel Angsuran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pinjam</th>
                            <th>Nama Anggota</th>
                            <th>Angsuran Ke</th>
                            <th>Nominal Angsuran</th>
                            <th>Sisa Angsuran</th>
                            <th>Waktu Pembayaran</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->loans->loan_code }}</td>
                                <td>{{ $item->loans->members->name }}</td>
                                <td>{{ $item->installment_number }}</td>
                                <td>Rp {{ number_format((($item->amount_installment * $option) / 100) + $item->amount_installment,0,".",".") }}</td>
                                <td>Rp {{ number_format((($item->remaining * $option) / 100) + $item->remaining,0,".",".") }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>
                                    <a href="{{ route('installment.show', $item->loans->members->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('installment.edit', $item->id) }}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
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
                    <h4 class="h5">Cetak Data Angsuran</h4>
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

        const url = "{{ route('print-installment', [ 'firstDate' => ':firstDate', 'lastDate' => ':lastDate' ]) }}"
            .replace(':firstDate', firstDate)
            .replace(':lastDate', lastDate);

        window.open(url, '_blank');
    }
</script>

