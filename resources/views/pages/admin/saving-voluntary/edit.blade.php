@extends("layouts.admin.admin")

@section("title")
    Ubah Simpanan Sukarela - Admin Koperasi
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Tambah Nominal Simpanan {{ $save->members->name }}</h3>
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
                <form action="{{ route("saving-voluntary.update", $save->id) }}" method="POST">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-primary">Nama Lengkap : {{ $save->members->name }}</p>
                                <p class="text-primary">Kode Anggota : {{ $save->members->member_number }}</p>
                            </div>
                            <div class="col">
                                <p class="text-primary mb-5">Hari, Tanggal : {{ \Carbon\Carbon::parse($save->created_at)->isoFormat("dddd, D MMMM YYYY") }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="amount_deposit">Nominal Simpanan Sukarela</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </span>
                                        <input type="number" id="input-number" name="amount_deposit" class="form-control" id="amount_deposit" value={{ $save->amount_deposit }}>
                                    </div>
                                    <span id="rupiah"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="status" for="description">Keterangan</label>
                                    <textarea class="form-control" name="description">{{ $save->description }}</textarea>
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

