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
        @elseif(session()->has("message"))
            <div class="alert alert-success">
                <p>{{  session()->get("message") }}</p>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Pengajuan Pinjaman</h3>
                <div class="card-options">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route("loan-process") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @forelse($options as $option)
                            <div class="row">
                                <div class="col">
                                    <p class="text-primary mb-5">Bunga : {{ $option->interest_rate }}%</p>
                                </div>
                                <div class="col">
                                    <p class="text-primary mb-5">Lama waktu pinjam : {{ $option->time_period }} bulan</p>
                                </div>
                            </div>
                        @empty
                            <p>Opsi belum ditetapkan</p>
                        @endforelse
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2" for="amount_loan">Jumlah Pinjaman</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="number" name="amount_loan" autocomplete="off"
                                       class="form-control{{ $errors->has('amount_loan') ? ' is-invalid' : '' }}"
                                       value="{{ old('amount_loan') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2" for="amount_deposit">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" autocomplete="off"
                                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                           value="{{ old('description') }}">
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
