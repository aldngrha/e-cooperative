@extends("layouts.admin.admin")

@section("title")
    Penarikan - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session()->has("message"))
            <div class="alert alert-success">
                <p>{{  session()->get("message") }}</p>
            </div>
        @endif
        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Tabel Penarikan</h1>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($withdraws as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->surplus_code }}</td>
                                <td>{{ $item->members->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                <td>Rp {{ number_format($item->amount_withdraw,0,".",".") }}</td>
                                <td>Rp {{ number_format($item->amount_withdraw / 2,0,".",".") }}</td>
                                <td>
                                    @if ($item->status == "PENDING")
                                        <span class="p-2 badge badge-secondary">
                                    @elseif ($item->status == "ACCEPT")
                                            <span class="p-2 badge badge-success">
                                    @elseif ($item->status == "DECLINE")
                                                <span class="p-2 badge badge-danger">
                                    @endif
                                            {{ $item->status }}
                                        </span>
                                        </span>
                                        </span>
                                        </span>
                                </td>
                                <td>
                                    <a href="{{ route('withdraw.show', $item->members->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('withdraw.edit', $item->id) }}" class="btn btn-warning">
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
                    <p class="text-primary">Jumlah Saldo Bunga : Rp {{ number_format($total < 0 ? 0 : $total,0,".",".") }}</p>
                    <form action="{{ route("withdraw.store") }}" method="POST">
                        @csrf
                        @if($total > 0)
                            <button type="submit" class="btn btn-primary">Masukkan ke modal</button>
                        @else
                            <button type="submit" class="btn btn-primary" disabled>Masukkan ke modal</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
