@extends("layouts.admin.admin")

@section("title")
    Dashboard Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Tabel Simpanan Pokok</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Jumlah Simpan</th>
                            <th>Keterangan</th>
                            <th>Waktu Pengajuan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->members->name }}</td>
                                <td>Rp {{ number_format($item->amount_deposit,0,".",".") }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>
                                    <a href="{{ route('saving.show', $item->members->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('option.destroy', $item->id) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
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
