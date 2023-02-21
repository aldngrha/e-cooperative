@extends("layouts.admin.admin")

@section("title")
    Modal Koperasi - Admin Koperasi
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
                <h6 class="h3 mb-2 text-primary font-weight-bold">Tabel Modal Koperasi</h6>
                <a href="{{ route('capital.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Modal</a>
            </div>
            <div class="card-body">
                <p class="text-primary">Jumlah Modal Koperasi : {{ $amount }}</p>
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nominal Modal</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($capitals as $capital)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $capital->amount_capital }}</td>
                                <td>{{ $capital->description }}</td>
                                <td>{{ $capital->created_at }}</td>
                                <td>
                                    <a href="{{ route('capital.edit', $capital->id) }}" class="btn btn-warning">
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
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
