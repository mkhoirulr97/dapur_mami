@if ($data->status == 0 && $data->payment_at == null)
    <span class="badge badge-warning">Menunggu Pembayaran</span>
@elseif ($data->status == 0 && $data->payment_at != null)
    <span class="badge badge-warning">Menunggu Konfirmasi</span>
@elseif ($data->status == 1)
    <span class="badge badge-primary">Pembayaran Diterima</span>
@elseif ($data->status == 2)
    <span class="badge badge-info">Pesanan Dikirim</span>
@elseif ($data->status == 3)
    <span class="badge badge-primary">Pesanan Diterima</span>
@elseif ($data->status == 4)
    <span class="badge badge-error">Pesanan Dibatalkan</span>
@endif
