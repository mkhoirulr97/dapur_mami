<div class="cart-item px-2 flex justify-between my-3 border border-gray-200 items-center rounded rounded-xl"
    id="cart-item-{{ $menu->id }}" data-name="{{ $menu->name }}" data-id="{{ $menu->id }}"
    data-price="{{ $menu->price }}" data-quantity="0" data-total="0">
    <div class="flex gap-x-2 items-center">
        <img class="w-10 h-10 rounded rounded-xl"
            src="{{ $menu->image ? asset($menu->image) : asset('images/menu/default.jpg') }}" alt="Default avatar">
        <div>
            <h3 class="font-semibold text-xs">
                {{ $menu->name }}
            </h3>
            <h3 class="text-xs" id="price-{{ $menu->id }}">
                Rp. {{ number_format($menu->price, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="flex gap-x-4">
        <x-input id="quantity-{{ $menu->id }}" onkeyup="hideConfirmationButton()" name="quantity" type="number" class="w-15" value="1"
            min="1" max="100" />
        <button onclick="removeCartItem('{{ $menu->id }}')">
            <i class="fas fa-trash-alt text-error"></i>
        </button>
    </div>
</div>
