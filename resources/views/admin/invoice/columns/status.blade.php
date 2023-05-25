@switch($status)
    @case(1)
        <span class="badge badge-sm badge-warning">Menunggu</span>
        @break
    @case(2)
        <span class="badge badge-sm badge-primary">Dibayar</span>
        @break
    @case(3)
        <span class="badge badge-sm badge-error">Dibatalkan</span>
        @break
    @default
        <span class="badge badge-sm badge-warning">Menunggu</span>
@endswitch
