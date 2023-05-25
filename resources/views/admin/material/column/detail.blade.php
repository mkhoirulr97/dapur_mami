<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Barang</th>
            <th>Tipe Unit</th>
            <th>Jumlah</th>
            <th>Harga/Unit</th>
            <th>Total</th>
            <th>Status Pembelian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->unit_type }}</td>
                <td>{{ $d->quantity }}</td>
                <td>
                    {{ number_format($d->ppu, 0, ',', '.') }}
                </td>
                <td>
                    {{ number_format($d->total, 0, ',', '.') }}
                </td>
                <td>
                    @if ($d->status == 0)
                        <span class="badge badge-warning">Belum diproses</span>
                    @elseif ($d->status == 1)
                        <span class="badge badge-primary">Sudah dibeli</span>
                    @elseif ($d->status == 2)
                        <span class="badge badge-error">
                            Tidak dibeli
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
