@extends("layouts.app")

@section("title")
    Pembayaran Angsuran - Koperasi
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
                <h3 class="card-title text-primary font-weight-bold">Pembayaran Angsuran</h3>
                <div class="card-options">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="text-primary">Nama Lengkap : {{ Auth::user()->name }}</p>
                            <p class="text-primary">Kode Anggota : {{ Auth::user()->member_number }}</p>
                            <p class="text-primary">Angsuran ke: <span id="installment_number">0</span></p>
                        </div>
                        <div class="col">
                            <p class="text-primary mb-5">Hari, Tanggal : {{ \Carbon\Carbon::parse(Date::now())->isoFormat("dddd, D MMMM YYYY") }}</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route("installment-checkout") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2" for="loans_id">Kode Pinjaman</label>
                                <div class="col-sm-10 mb-3">
                                    <select name="loans_id" class="form-control" id="loans_id">
                                        <option value="">-- Pilih Kode Pinjam --</option>
                                        @foreach ($loanData as $id => $data)
                                            <option value="{{ $id }}" data-installment-number="{{ $data['next_installment_number'] }}" {{ $selectedLoanId == $id ? 'selected' : '' }} >
                                                {{ $data['loan']->loan_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                        <button type="submit" class="btn btn-primary">Bayar Angsuran</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>

    <script>
        // Get the dropdown element
        const loansSelect = document.getElementById('loans_id');

        // Get the element to display the installment number
        const installmentNumberEl = document.getElementById('installment_number');

        // Listen for changes to the selected option
        loansSelect.addEventListener('change', function() {
            // Get the selected option
            const selectedOption = loansSelect.options[loansSelect.selectedIndex];

            // Get the installment number from the selected option's data attribute
            const installmentNumber = selectedOption.dataset.installmentNumber;

            // Update the element to display the installment number
            installmentNumberEl.textContent = installmentNumber;
        });
    </script>

@endsection
