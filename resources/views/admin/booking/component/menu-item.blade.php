<div class="cart-item p-2 flex justify-between my-3 border border-gray-200 items-center rounded rounded-xl"
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

    <div class="inline-flex rounded-md shadow-sm gap-x-2" role="group">
        <button type="button" onClick="removeQuantity({{ $menu->id }})"
            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-xs w-5 h-5 text-center">
            <i class="fa-solid fa-minus"></i>
        </button>
        <span class="text-sm font-medium text-gray-700 quantity">0</span>
        <button type="button" onClick="addQuantity({{ $menu->id }})"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-xs w-5 h-5 text-center">
            <i class="fa-solid fa-plus"></i>
        </button>
        <span class="text-gray-300">|</span>
        <button type="button" onClick="removeCart({{ $menu->id }})"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-xs w-5 h-5 text-center">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
</div>
