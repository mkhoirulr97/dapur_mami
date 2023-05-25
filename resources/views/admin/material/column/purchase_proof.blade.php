<div class="avatar">
    <div class="w-16 rounded">
        <a href="{{ $data->purchase_proof
            ? asset('storage/purchase_proof/' . $data->purchase_proof)
            : asset('images/menu/default.jpg') }}"
            target="_blank">
            <img src="{{ $data->purchase_proof ? asset('storage/purchase_proof/' . $data->purchase_proof) : asset('images/menu/default.jpg') }}"
                alt="{{ $data->purchase_proof }}" />
        </a>
    </div>
</div>
