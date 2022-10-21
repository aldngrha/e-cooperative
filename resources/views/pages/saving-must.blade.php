@extends("layouts.app")

@section("title")
    Dashboard Admin Koperasi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Pengajuan Simpanan Wajib</h3>
                <div class="card-options">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('saving.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2">Anggota</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="select2" name="anggota">
                                        <option value="">-- Pilih Anggota --</option>
                                        <option value="Anggota" ></option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2">Jumlah Simpanan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </span>
                                        <input type="number" name="jumlah" autocomplete="off" class="form-control{{ $errors->has('amount_deposit') ? ' is-invalid' : '' }}" value="{{ old('amount_deposit') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="keterangan" autocomplete="off" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Ajukan Simpanan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
