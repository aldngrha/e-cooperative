@extends("layouts.admin.admin")

@section("title")
    Ubah Angsuran - Admin Koperasi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Masukkan Nominal Pembayaran Angsuran {{ $installment->loans->members->name }}</h3>
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
                <form action="{{ route("installment.update", $installment->id) }}" method="POST">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-primary">Nama Lengkap : {{ $installment->loans->members->name }}</p>
                                <p class="text-primary">Kode Anggota : {{ $installment->loans->members->member_number }}</p>
                                <p class="text-primary">Angsuran Ke : {{ $installment->installment_number }}</p>
                            </div>
                            <div class="col">
                                <p class="text-primary">Kode Pinjam : {{ $installment->loans->loan_code }}</p>
                                <p class="text-primary">Hari, Tanggal : {{ \Carbon\Carbon::parse($installment->created_at)->isoFormat("dddd, D MMMM YYYY") }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="amount_installment">Nominal Pembayaran Angsuran</label>
                                    <input type="number" name="amount_installment" class="form-control" id="amount_installment" value={{ $installment->amount_installment }}>
                                </div>
                                <div class="form-group">
                                    <label class="status" for="description">Keterangan</label>
                                    <textarea class="form-control" name="description">{{ $installment->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="interest_rate">Nominal Bunga Angsuran</label>
                                    <input type="number" name="interest_rate" class="form-control" id="interest_rate" value={{ $installment->interest_rate }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Masukkan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
