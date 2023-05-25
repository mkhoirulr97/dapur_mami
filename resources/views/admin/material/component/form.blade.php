<div class="sm:flex justify-between">
    <x-input id="name" name="name" label="Nama Bahan" type="text" required />
    <x-input id="quantity" name="quantity" label="Jumlah" type="number" required />
    <x-select id="unit_type" name="unit_type" label="Satuan" required class="max-w-sm">
        <option value="kg">Kilogram</option>
        <option value="g">Gram</option>
        <option value="mg">Miligram</option>
        <option value="l">Liter</option>
        <option value="ml">Mililiter</option>
        <option value="pcs">Pcs</option>
    </x-select>
    <x-input id="ppu" name="ppu" label="Harga" type="number" required />
    <x-input id="total" name="total" label="Total" type="number" required readonly />
</div>
