@extends("layouts.app")

@section("title")
    Penarikan Sisa Hasil Usaha - Koperasi
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
        @elseif(session()->has("error"))
            <div class="alert alert-danger">
                <p>{{  session()->get("error") }}</p>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Penarikan Sisa Hasil Usaha</h3>
                <div class="card-options">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="text-primary">Jumlah Saldo Bunga :</p>
                            <p class="text-primary">Keuntungan Koperasi :</p>
                            <p class="text-primary">Keuntungan Anggota :</p>
                        </div>
                        <div class="col">
                            <p class="text-primary">Rp {{ number_format($rate,0,".",".") }}</p>
                            <p class="text-primary">50%</p>
                            <p class="text-primary">50%</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-decoration-underline">*Penarikan hanya bisa dilakukan 1x dan hanya bisa dilakukan pada {{ \Carbon\Carbon::parse($date)->isoFormat("dddd, D MMMM YYYY") }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p class="text-primary">Nama Lengkap : {{ Auth::user()->name }}</p>
                            <p class="text-primary">Kode Anggota : {{ Auth::user()->member_number }}</p>
                        </div>
                        <div class="col">
                            <p class="text-primary mb-5">Hari, Tanggal : {{ \Carbon\Carbon::parse(Date::now())->isoFormat("dddd, D MMMM YYYY") }}</p>
                        </div>
                    </div>
                </div>
                @if (\Carbon\Carbon::now()->format('m-d') == $option)
                    <form action="{{ route("withdraw") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-2" for="amount_withdraw">Jumlah Pinjaman</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </span>
                                            <input type="number" name="amount_withdraw" autocomplete="off"
                                               class="form-control{{ $errors->has('amount_withdraw') ? ' is-invalid' : '' }}"
                                               value="{{ old('amount_withdraw') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Tarik SHU</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
