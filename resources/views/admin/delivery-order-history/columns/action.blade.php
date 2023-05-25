<div class="inline-flex gap-x-2">
    @if ($data->status == 0 && $data->payment_at != null)
        <x-link-button class="bg-primary" onclick="btnChangeStatus('{{ $data->id }}', 1)">
            <i class="far fa-check-circle mr-2"></i>
            Konfirmasi Pembayaran
        </x-link-button>
    @elseif ($data->status == 1)
        <x-link-button class="bg-primary" onclick="btnChangeStatus('{{ $data->id }}', 2)">
            <i class="fas fa-truck mr-2"></i>
            Konfirmasi Pengiriman
        </x-link-button>
    @elseif ($data->status == 2)
        <x-link-button class="bg-primary" onclick="btnChangeStatus('{{ $data->id }}', 3)">
            <i class="fas fa-square-check mr-2"></i>
            Konfirmasi Penerimaan
        </x-link-button>
    @endif
</div>
