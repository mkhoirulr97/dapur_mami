<div class="inline-flex gap-x-2">
    <a href="{{ route('admin.cashier.edit', $data->id) }}" class="btn btn-sm btn-primary">
        <small><i class="fas fa-edit"></i></small>
    </a>
    <a href="#modal" class="btn btn-sm" onclick="btnDelete('{{$data->id}}', '{{$data->fullname}}')">
        <small><i class="fas fa-trash"></i></small>
    </a>
</div>
