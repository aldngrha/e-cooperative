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
    <title>Cetak Data Angsuran</title>
</head>
<body>
<div class="form-group">
    <h4 align="center">KOPERASI SIMPAN PINJAM GURU “SMK TRISAKTI JAYA BANDAR LAMPUNG”
        LAPORAN ANGSURAN ANGGOTA UNTUK PERIODE BULAN {{ strtoupper($month) }} TAHUN {{ $year }}  </h4>
    <table class="static" align="center" rules="all" border="1" style="width: 95%">
        <thead align="center" style="background: yellow">
            <tr>
                <th>Kode Anggota</th>
                <th>Tanggal Pinjaman</th>
                <th>Nama Anggota</th>
                <th>Angsuran Ke</th>
                <th>Jumlah Angsuran (RP)</th>
                <th>Sisa Angsuran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody align="center">
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->loans->members->member_number }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat("DD MMMM YYYY") }}</td>
                <td>{{ $item->loans->members->name }}</td>
                <td>{{ $item->installment_number }}</td>
                <td>Rp{{ number_format((($item->amount_installment * $option) / 100) + $item->amount_installment,0,".",".") }}</td>
                <td>Rp{{ number_format((($item->remaining * $option) / 100) + $item->remaining,0,".",".") }}</td>
                <td>{{ $item->description }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Data kosong
                </td>
            </tr>
        @endforelse
        <tr>
            <td colspan="4">Total</td>
            <td>Rp{{ number_format($amount_installment,0,".",".") }}</td>
            <td>Rp{{ number_format($rate,0,".",".") }}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
