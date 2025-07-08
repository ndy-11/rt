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
        @php
            // Data harus sudah diurutkan berdasarkan RW, RT, Bulan
            $sorted = $data->sortBy([
                fn($a, $b) => $a->no_rw <=> $b->no_rw,
                fn($a, $b) => $a->no_rt <=> $b->no_rt,
                fn($a, $b) => $a->bulan <=> $b->bulan,
            ])->values();

            $rwCounts = $sorted->groupBy('no_rw')->map->count();
            $rtCounts = $sorted->groupBy(fn($item) => $item->no_rw.'|'.$item->no_rt)->map->count();
            $bulanCounts = $sorted->groupBy(fn($item) => $item->no_rw.'|'.$item->no_rt.'|'.$item->bulan)->map->count();
            $rwPrinted = [];
            $rtPrinted = [];
            $bulanPrinted = [];
        @endphp
        @foreach($sorted as $item)
        <tr>
            @php
                $rwKey = $item->no_rw;
                $rtKey = $item->no_rw.'|'.$item->no_rt;
                $bulanKey = $item->no_rw.'|'.$item->no_rt.'|'.$item->bulan;
            @endphp
            @if(!isset($rwPrinted[$rwKey]))
                <td rowspan="{{ $rwCounts[$rwKey] }}">{{ $item->no_rw }}</td>
                @php $rwPrinted[$rwKey] = true; @endphp
            @endif
            @if(!isset($rtPrinted[$rtKey]))
                <td rowspan="{{ $rtCounts[$rtKey] }}">{{ $item->no_rt }}</td>
                @php $rtPrinted[$rtKey] = true; @endphp
            @endif
            @if(!isset($bulanPrinted[$bulanKey]))
                <td rowspan="{{ $bulanCounts[$bulanKey] }}">
                    @if(is_numeric($item->bulan) && $item->bulan >= 1 && $item->bulan <= 12)
                        {{ \Carbon\Carbon::parse('2023-' . str_pad($item->bulan, 2, '0', STR_PAD_LEFT) . '-01')->translatedFormat('F') }}
                    @else
                        {{ $item->bulan }}
                    @endif
                </td>
                @php $bulanPrinted[$bulanKey] = true; @endphp
            @endif
            <td>{{ $item->no_kk ?? '-' }}</td>
            <td>{{ $item->nik ?? '-' }}</td>
            <td>{{ $item->nama ?? '-' }}</td>
            <td>{{ $item->jkel === 'L' ? 'Laki-laki' : ($item->jkel === 'P' ? 'Perempuan' : ($item->jkel ?? '-')) }}</td>
            <td>{{ $item->alamat ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>