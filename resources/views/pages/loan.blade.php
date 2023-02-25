@extends("layouts.app")

@section("title")
    Pengajuan Pinjaman - Koperasi
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
                <h3 class="card-title text-primary font-weight-bold">Pengajuan Pinjaman</h3>
                <div class="card-options">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    @forelse($options as $option)
                        <div class="row mb-4">
                            <div class="col-3">
                                <p class="text-primary">Lama waktu pinjam : {{ $option->time_period }} bulan</p>
                            </div>
                            <div class="col-2">
                                <p class="text-primary">Bunga : {{ $option->interest_rate }}%</p>
                            </div>
                        </div>
                    @empty
                        <p>Ketentuan belum ditetapkan</p>
                    @endforelse
                    <div class="row">
                        <div class="col">
                            <p class="text-primary">Nama Lengkap : {{ Auth::user()->name }}</p>
                            <p class="text-primary">Kode Anggota : {{ Auth::user()->member_number }}</p>
                        </div>
                        <div class="col">
                            <p class="text-primary mb-5">Hari, Tanggal : {{ \Carbon\Carbon::parse(Date::now())->isoFormat("dddd, D MMMM YYYY") }}</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route("loan-process") }}" method="POST">
                    @csrf
                    <div class="card-body">
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
                            <div class="row">
                                <label class="col-sm-2" for="amount_deposit">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="description" autocomplete="off"
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
                                        {{ old("description") }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
