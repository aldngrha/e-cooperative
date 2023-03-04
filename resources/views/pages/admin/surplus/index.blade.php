@extends("layouts.admin.admin")

@section("title")
    Laporan Sisa Hasil Usaha - Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Laporan Sisa Hasil Usaha</h1>
            </div>
            <div class="card-body">
                <div class="d-block">
                    <form id="form-surplus">
                        @csrf
                        <div class="row">
                            <div class="col-12">
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
    <script>
        function checkInput() {
            const year = $('#year').val();

            if (year) {
                $('#print-btn').prop('disabled', false);
            } else {
                $('#print-btn').prop('disabled', true);
            }
        }

        $(document).ready(function () {
            $('#form-surplus').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('report') }}",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#table-data tbody').empty(); // menghapus isi dari tbody
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td>Penerimaan</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td>Seluruh Penerimaan</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.income,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Pengeluaran</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td></td>' +
                            '<td>Seluruh Pengeluaran</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.outcome,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="3">Total</td>' +
                            '<td>Rp ' + number_format(response.total,0,".",".") + '</td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="2">Pendapatan Kotor</td>' +
                            '<td>Rp ' + number_format(response.total,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="2">SHU Yang Dibagi</td>' +
                            '<td>Rp ' + number_format(response.withdraw,0,".",".") + '</td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $('#table-data tbody').append(
                            '<tr>' +
                            '<td colspan="2">SHU Ditahan</td>' +
                            '<td></td>' +
                            '<td>Rp ' + number_format(response.hold,0,".",".") + '</td>' +
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
                let selectedYear = $('#year').val();
                var table = $('<table>');

                e.preventDefault();
                var table = $('#table-data').clone();
                var newWindow = window.open();
                newWindow.document.write('<html><head><title>Laporan Sisa Hasil Usaha</title>');
                newWindow.document.write('</head><body>');
                newWindow.document.write('<h4 align="center">KOPERASI SIMPAN PINJAM GURU “SMK TRISAKTI JAYA BANDAR LAMPUNG”\ LAPORAN SISA HASIL USAHA (SHU) UNTUK PERIODE TAHUN ' + selectedYear + '</h4>');
                newWindow.document.write(table[0].outerHTML);
                newWindow.document.write('</body></html>');
                newWindow.document.close();
                newWindow.print();
            });
        });
    </script>
@endpush
