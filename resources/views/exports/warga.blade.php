<table>
    <thead>
        <tr>
            <th>RW</th>
            <th>RT</th>
            <th>Bulan</th>
            <th>No KK</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->no_rw ?? '-' }}</td>
            <td>{{ $item->no_rt ?? '-' }}</td>
            <td>
                @if(isset($item->bulan) && is_numeric($item->bulan) && $item->bulan >= 1 && $item->bulan <= 12)
                    {{ \Carbon\Carbon::parse('2023-' . str_pad($item->bulan, 2, '0', STR_PAD_LEFT) . '-01')->translatedFormat('F') }}
                @elseif(isset($item->bulan))
                    {{ $item->bulan }}
                @else
                    -
                @endif
            </td>
            <td>{{ $item->no_kk ?? '-' }}</td>
            <td>{{ $item->nik ?? '-' }}</td>
            <td>{{ $item->nama ?? '-' }}</td>
            <td>
                @php
                    $jk = $item->jkel ?? '';
                    if ($jk === 'L') $jk = 'Laki-laki';
                    elseif ($jk === 'P') $jk = 'Perempuan';
                @endphp
                {{ $jk ?: '-' }}
            </td>
            <td>{{ $item->alamat ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
