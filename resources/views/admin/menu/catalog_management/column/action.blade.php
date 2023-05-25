<div class="inline-flex gap-x-2">
    <a href="{{ route('admin.catalog-management.edit', $id) }}" class="btn btn-sm btn-primary">
        <small><i class="fas fa-edit"></i></small>
    </a>
    <a href="#my-modal-{{ $id }}" class="btn btn-sm">
        <small><i class="fas fa-trash"></i></small>
    </a>
</div>

<div class="modal" id="my-modal-{{ $id }}">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Peringatan!</h3>
        <p class="py-4">
            Apakah anda yakin ingin menghapus menu ini?
        </p>
        <div class="modal-action">
            <x-link-button route="#" color="gray">Batal</x-link-button>
            <form action="{{ route('admin.catalog-management.destroy', $id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" color="red">Hapus</x-button>
            </form>
        </div>
    </div>
</div>
