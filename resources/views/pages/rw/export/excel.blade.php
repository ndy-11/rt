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
        @php $grouped = $data->groupBy('no_rw'); @endphp
        @foreach($grouped as $rw => $rwData)
            @php $rwPrinted = false; @endphp
            @foreach($rwData as $item)
            <tr>
                <td>
                    @if (!$rwPrinted)
                        {{ $rw }}
                        @php $rwPrinted = true; @endphp
                    @endif
                </td>
                <td>{{ $item->no_rt }}</td>
                <td>{{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}</td>
                <td>{{ $item->laki }}</td>
                <td>{{ $item->perempuan }}</td>
                <td>{{ $item->laki + $item->perempuan }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
