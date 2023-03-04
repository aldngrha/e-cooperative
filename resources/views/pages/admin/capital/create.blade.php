@extends("layouts.admin.admin")

@section("title")
    Tambah Modal - Admin Koperasi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Tambah Modal Koperasi</h3>
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
                <form action="{{ route("capital.store") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mt-4">
                                    <label class="status" for="amount_capital">Nominal Modal</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </span>
                                        <input type="number" id="input-number" name="amount_capital" class="form-control" id="amount_capital" value="{{ old("amount_capital") }}">
                                    </div>
                                    <span id="rupiah"></span>
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
