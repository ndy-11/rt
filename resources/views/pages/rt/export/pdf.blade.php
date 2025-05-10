<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Penduduk</title>
    <style>
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <h2>Laporan Data Warga per RT/RW</h2>
    <table>
        <thead>
            <tr>
                <th>RW</th>
                <th>RT</th>
                <th>Bulan</th>
                <th>L</th>
                <th>P</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekap as $item)
                <tr>
                    <td>{{ $item->rw }}</td>
                    <td>{{ $item->rt }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->l }}</td>
                    <td>{{ $item->p }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
