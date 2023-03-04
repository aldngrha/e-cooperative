@extends("layouts.admin.admin")

@section("title")
    Laporan Arus Kas - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Laporan Arus Kas</h1>
            </div>
            <div class="card-body">
                <div class="d-block">
                    <form id="form-cashflow">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="month">Bulan:</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">-- Pilih Bulan --</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="year">Tahun:</label>
                                    <input type="number" name="year" id="year" class="form-control" min="2000" max="2099" step="1">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button id="btn-tampil" type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive mt-4">
                    <table id="table-data" class="table table-bordered table-vcenter text-nowrap" width="100%" cellspacing="0" border="1">
                        <thead align="center">
                        <tr>
                            <th>Bulan</th>
                            <th colspan="2">Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                        </tr>
                        </thead>
                        <tbody align="center">
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <button id="print-btn" class="btn btn-primary" style="display: none;"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push("after-script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        function checkInput() {
            const month = $('#month').val();
            const year = $('#year').val();

            if (month && year) {
                $('#print-btn').prop('disabled', false);
            } else {
                $('#print-btn').prop('disabled', true);
            }
        }

        $(document).ready(function () {
            $('#form-cashflow').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('data') }}",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#table-data tbody').empty(); // menghapus isi dari tbody
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td>' + $('#month option:selected').text() + ' ' + $('#year').val() + '</td>' +
                            '<td>Angsuran Masuk</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.installment,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Simpanan Wajib</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.depositMust,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Simpanan Pokok</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.deposit,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Simpanan Sukarela</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.depositVoluntary,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Simpanan Modal</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.capital,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Saldo Awal Bulan</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.balance,0,".",".") + '</td>' +
                            '<td></td>' +
                        '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>Peminjaman Anggota</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.loan,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>Pengeluaran Koperasi</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.expense,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>Pengambilan SHU</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.withdraw,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Keuntungan Bunga '+ $('#year').val() +'</td>' +
                            '<td colspan="2">Rp ' + number_format(response.interest,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Keuntungan Bunga Keseluruhan</td>' +
                            '<td colspan="2">Rp ' + number_format(response.rate,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Saldo Per Bulan '+ $('#month option:selected').val() + '/' + $('#year').val() +'</td>' +
                            '<td colspan="2">Rp ' + number_format(response.monthBalance,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Total Piutang Pinjaman</td>' +
                            '<td colspan="2">Rp ' + number_format(response.totalLoan,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Nilai Total Kekayaan Koperasi</td>' +
                            '<td colspan="2">Rp ' + number_format(response.wealth,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#print-btn').prop('disabled', false);
                        // menampilkan tombol cetak
                        $('#print-btn').css('display', 'block');
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#print-btn').on('click', function (e) {
                let selectedMonth = $('#month option:selected').text().toUpperCase();
                let selectedYear = $('#year').val();
                var table = $('<table>');

                table.addClass('table table-bordered table-striped');

                e.preventDefault();
                var table = $('#table-data').clone();
                var newWindow = window.open();
                newWindow.document.write('<html><head><title>Laporan Arus Kas</title>');
                newWindow.document.write('</head><body>');
                newWindow.document.write('<h4 align="center">KOPERASI SIMPAN PINJAM GURU “SMK TRISAKTI JAYA BANDAR LAMPUNG”\ LAPORAN ARUS KAS UNTUK PERIODE BULAN ' + selectedMonth + ' TAHUN ' + selectedYear + '</h4>');
                newWindow.document.write(table[0].outerHTML);
                newWindow.document.write('</body></html>');
                newWindow.document.close();
                newWindow.print();
            });
        });
    </script>
@endpush
