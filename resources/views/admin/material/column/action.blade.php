<div class="inline-flex gap-x-2">
    @if (auth()->user()->role == 1)
        @if ($data->status == 1)
            <x-link-button onclick="process('{{ $data->id }}')" class="bg-primary">
                <span>Proses</span>
            </x-link-button>
        @elseif ($data->status == 2)
            <x-link-button route="{{ route('admin.material.edit', $data->id) }}" class="bg-primary">
                Konfirmasi Pembelian
            </x-link-button>
        @elseif ($data->status == 3)
            <x-link-button route="{{ route('admin.material.edit', $data->id) }}" class="bg-primary">
                Ubah Pembelian
            </x-link-button>
        @endif
    @else
        @if ($data->status == 1)
            <a href="{{ route('admin.material.edit', $data->id) }}" class="btn btn-sm btn-primary">
                <small><i class="fas fa-edit"></i></small>
            </a>
            <a href="{{ route('admin.menu.show', $data->id) }}" class="btn btn-sm">
                <small>
                    <i class="fas fa-eye"></i>
                </small>
            </a>
            <a href="#modal-{{ $data->id }}" class="btn btn-sm">
                <small><i class="fas fa-trash"></i></small>
            </a>
        @elseif ($data->status == 2)
            <span class="badge">
                Pembelian Diproses
            </span>
        @elseif ($data->status == 3)
            <span class="badge badge-primary">
                Pembelian Selesai
            </span>
        @endif
    @endif
</div>
