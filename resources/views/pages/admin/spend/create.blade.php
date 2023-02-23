@extends("layouts.admin.admin")

@section("title")
    Tambah Pengeluaran Koperasi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Tambah Pengeluaran Koperasi</h3>
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
                <form action="{{ route("spend.store") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mt-4">
                                    <label class="status" for="amount_spend">Nominal Pengeluaran</label>
                                    <input type="number" name="amount_spend" class="form-control" id="amount_spend" value="{{ old("amount_spend") }}">
                                </div>
                                <div class="form-group">
                                    <label class="status" for="description">Keterangan</label>
                                    <textarea class="form-control" name="description">{{ old("description") }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
