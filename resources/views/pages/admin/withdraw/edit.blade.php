@extends("layouts.admin.admin")

@section("title")
    Ubah Status Penarikan
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Ubah Status Penarikan {{ $withdraw->members->name }}</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <form action="{{ route("withdraw.update", $withdraw->id) }}" method="POST">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-primary">Nama Lengkap : {{ $withdraw->members->name }}</p>
                                <p class="text-primary">Kode Anggota : {{ $withdraw->members->member_number }}</p>
                            </div>
                            <div class="col">
                                <p class="text-primary mb-5">Hari, Tanggal : {{ \Carbon\Carbon::parse($withdraw->created_at)->isoFormat("dddd, D MMMM YYYY") }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status">Status Pinjaman</label>
                                    <select name="status" required class="form-control">
                                        <option value="{{ $withdraw->status }}">Tentukan Status Penarikan</option>
                                        <option value="PENDING">TERTUNDA</option>
                                        <option value="ACCEPT">DISETUJUI</option>
                                        <option value="DECLINE">TIDAK DISETUJUI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
