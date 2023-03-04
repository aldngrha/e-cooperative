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
                                        <input type="number" id="input-number" name="amount_loan" autocomplete="off"
                                           class="form-control{{ $errors->has('amount_loan') ? ' is-invalid' : '' }}"
                                        value="{{ old('amount_loan') }}">
                                    </div>
                                    <span id="rupiah"></span>
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
