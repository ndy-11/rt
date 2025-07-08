<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Penduduk per RW/RT</title>
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
        tfoot { display: table-row-group; }
        tr { page-break-inside: avoid !important; }
        td, th { background-clip: padding-box; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <h2>Laporan Data Warga per RW/RT</h2>
    @php
        $maxRowsPerPage = 15; // batas maksimal baris per halaman
        $rowCount = 0;
    @endphp

    @php
        // Bagi data menjadi pages
        $pages = [];
        $currentPage = [];
        foreach($rekap as $item) {
            if ($rowCount > 0 && $rowCount % $maxRowsPerPage == 0) {
                $pages[] = $currentPage;
                $currentPage = [];
            }
            $currentPage[] = $item;
            $rowCount++;
        }
        if (count($currentPage)) {
            $pages[] = $currentPage;
        }
    @endphp

    @foreach($pages as $pageIdx => $pageData)
        <table>
            <thead>
                <tr>
                    <th>RW</th>
                    <th>RT</th>
                    <th>Bulan</th>
                    <th>NO KK</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rwCounts = [];
                    $rtCounts = [];
                    foreach($pageData as $item) {
                        $rw = $item->rw;
                        $rt = $item->rt;
                        $rwCounts[$rw] = ($rwCounts[$rw] ?? 0) + 1;
                        $rtCounts[$rw.'|'.$rt] = ($rtCounts[$rw.'|'.$rt] ?? 0) + 1;
                    }
                    $rwShown = [];
                    $rtShown = [];
                @endphp
                @foreach($pageData as $item)
                    <tr>
                        @if(!isset($rwShown[$item->rw]))
                            <td rowspan="{{ $rwCounts[$item->rw] }}">{{ $item->rw }}</td>
                            @php $rwShown[$item->rw] = true; @endphp
                        @endif
                        @if(!isset($rtShown[$item->rw.'|'.$item->rt]))
                            <td rowspan="{{ $rtCounts[$item->rw.'|'.$item->rt] }}">{{ $item->rt }}</td>
                            @php $rtShown[$item->rw.'|'.$item->rt] = true; @endphp
                        @endif
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->no_kk }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            {{-- Tampilkan jenis kelamin dengan fallback dan normalisasi --}}
                            @php
                                $jk = $item->jkel ?? $item->jenis_kelamin ?? '';
                                // Normalisasi jika ada kemungkinan singkatan/huruf
                                if (strtoupper($jk) === 'L' || strtolower($jk) === 'laki-laki') {
                                    $jk = 'Laki-laki';
                                } elseif (strtoupper($jk) === 'P' || strtolower($jk) === 'perempuan') {
                                    $jk = 'Perempuan';
                                }
                            @endphp
                            {{ $jk ?: '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($pageIdx < count($pages) - 1)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
