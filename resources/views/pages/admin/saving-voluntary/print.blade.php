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
    <title>Cetak Data Simpanan Sukarela</title>
</head>
<body>
<div class="form-group">
    <h4 align="center">KOPERASI SIMPAN PINJAM GURU “SMK TRISAKTI JAYA BANDAR LAMPUNG”
        LAPORAN SIMPANAN SUKARELA UNTUK PERIODE BULAN {{ strtoupper($month) }} TAHUN {{ $year }}  </h4>
    <table class="static" align="center" rules="all" border="1" style="width: 95%">
        <thead align="center" style="background: Yellow">
            <tr>
                <th>No</th>
                <th>Kode Anggota</th>
                <th>Nama Anggota</th>
                <th>Jumlah Simpanan Wajib</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody align="center">
        @forelse ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->members->member_number }}</td>
                <td>{{ $item->members->name }}</td>
                <td>Rp {{ number_format($item->amount_deposit,0,".",".") }}</td>
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
            <td colspan="3">Total</td>
            <td>Rp</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
