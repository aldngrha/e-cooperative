@extends("layouts.admin.admin")

@section("title")
    Pengeluaran Koperasi - Admin Koperasi
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
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="h3 mb-2 text-primary font-weight-bold">Tabel Pengeluaran Koperasi</h6>
                <a href="{{ route('spend.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengeluaran</a>
            </div>
            <div class="card-body">
                <p class="text-primary">Jumlah Pengeluaran Koperasi : Rp {{ number_format($amount,0,".",".") }}</p>
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal Modal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($spends as $spend)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($spend->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>{{ $spend->description }}</td>
                                <td>Rp {{ number_format($spend->amount_spend,0,".",".") }}</td>
                                <td>
                                    <a href="{{ route('spend.edit', $spend->id) }}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('spend.destroy', $spend->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
