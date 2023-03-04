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
                        <div class="row">
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
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-primary">Nominal Pembayaran : Rp {{ number_format($nominal,0,".",".") }}</p>
                            </div>
                            <div class="col">
                                <p class="text-primary">Nominal Bunga : Rp {{ number_format($interest,0,".",".") }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="amount_installment">Nominal Pembayaran Angsuran</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </span>
                                        <input type="number" id="input-number" name="amount_installment" class="form-control" id="amount_installment" value={{ $installment->amount_installment }}>
                                    </div>
                                    <span id="rupiah"></span>
                                </div>
                                <div class="form-group">
                                    <label class="status" for="description">Keterangan</label>
                                    <textarea class="form-control" name="description">{{ $installment->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="interest_rate">Nominal Bunga Angsuran</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </span>
                                        <input type="number" id="input-number2" name="interest_rate" class="form-control" id="interest_rate" value={{ $installment->interest_rate }}>
                                    </div>
                                    <span id="rupiah2"></span>
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
@push("after-script")
    <script>
        // Ambil elemen input dan span dari DOM
        let inputNumber = document.getElementById('input-number');
        let spanRupiah = document.getElementById('rupiah');

        // Tambahkan event listener 'input' pada inputNumber
        inputNumber.addEventListener('input', function() {
            // Dapatkan nilai input dari elemen inputNumber
            let value = inputNumber.value;

            // Validasi nilai input, hanya menerima angka dan koma
            value = value.replace(/[^\d\,]/g, '');

            // Jika nilai input kosong, jangan tampilkan apa-apa di dalam spanRupiah
            if (value == '') {
                spanRupiah.innerText = '';
                return;
            }

            // Ubah nilai input menjadi format rupiah menggunakan fungsi formatRupiah
            let formattedValue = formatRupiah(value);

            // Tampilkan nilai input yang sudah diformat pada spanRupiah
            spanRupiah.innerText = '* Rp ' + formattedValue;
        });

        // Ambil elemen input dan span dari DOM
        let inputNumber2 = document.getElementById('input-number2');
        let spanRupiah2 = document.getElementById('rupiah2');

        // Tambahkan event listener 'input' pada inputNumber
        inputNumber2.addEventListener('input', function() {
            // Dapatkan nilai input dari elemen inputNumber
            let value = inputNumber2.value;

            // Validasi nilai input, hanya menerima angka dan koma
            value = value.replace(/[^\d\,]/g, '');

            // Jika nilai input kosong, jangan tampilkan apa-apa di dalam spanRupiah
            if (value == '') {
                spanRupiah2.innerText = '';
                return;
            }

            // Ubah nilai input menjadi format rupiah menggunakan fungsi formatRupiah
            let formattedValue = formatRupiah(value);

            // Tampilkan nilai input yang sudah diformat pada spanRupiah
            spanRupiah2.innerText = '* Rp ' + formattedValue;
        });

        // Fungsi formatRupiah untuk mengubah nilai input menjadi format rupiah
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }
    </script>
@endpush
