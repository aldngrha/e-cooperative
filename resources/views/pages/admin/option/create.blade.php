@extends("layouts.admin.admin")

@section("title")
    Admin Koperasi - Opsi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Opsi</h3>
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
                <form action="{{ route("option.store") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="interest_rate">Bunga (%)</label>
                                    <input type="number" name="interest_rate" placeholder="masukkan bunga pinjaman" class="form-control{{ $errors->has('interest_rate') ? ' is-invalid' : '' }}" value="{{ old("interest_rate") }}">
                                    @if ($errors->has('interest_rate'))
                                        <span class="invalid-feedback">{{ $errors->first('interest_rate') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="time_period">Lama Pinjam (dalam bulan)</label>
                                    <input type="number" name="time_period" placeholder="masukkan lama waktu pinjaman" class="form-control{{ $errors->has('time_period') ? ' is-invalid' : '' }}" value="{{ old("time_period") }}">
                                    @if ($errors->has('time_period'))
                                        <span class="invalid-feedback">{{ $errors->first('time_period') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="date_withdraw">Tanggal Penarikan SHU</label>
                                    <input type="date" name="date_withdraw" placeholder="masukkan lama waktu pinjaman" class="form-control{{ $errors->has('date_withdraw') ? ' is-invalid' : '' }}" value="{{ old("date_withdraw") }}">
                                    @if ($errors->has('date_withdraw'))
                                        <span class="invalid-feedback">{{ $errors->first('date_withdraw') }}</span>
                                    @endif
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
