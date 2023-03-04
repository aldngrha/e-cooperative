<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static {
            position: relative;
            border: 1px solid #000;
        }

        td.no-border {
            border-bottom: none;
        }

        @media print {
            thead {
                background-color: yellow;
            }
        }
    </style>
    <title>Cetak Data Penarikan SHU</title>
</head>
<body>
<div class="form-group">
    <h4 align="center">KOPERASI SIMPAN PINJAM GURU “SMK TRISAKTI JAYA BANDAR LAMPUNG”
        LAPORAN PENARIKAN SHU OLEH ANGGOTA UNTUK PERIODE TAHUN {{ $year }}  </h4>
    <table class="static" align="center" rules="all" border="1" style="width: 95%">
        <thead align="center" style="background: Yellow">
            <tr>
                <th>Kode Anggota</th>
                <th>Tanggal Penarikan</th>
                <th>Nama Anggota</th>
                <th>Jumlah Penarikan (RP)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody align="center">
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->members->member_number }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("DD MMMM YYYY") }}</td>
                <td>{{ $item->members->name }}</td>
                <td>Rp{{ number_format($item->amount_withdraw,0,".",".") }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Data kosong
                </td>
            </tr>
        @endforelse
        <tr>
            <td colspan="3">Total</td>
            <td>Rp{{ number_format($amount_withdraw,0,".",".") }}</td>
        </tr>
        </tbody>
    </table>
</div>
<script>
    window.print();
</script>
</body>
</html>
