<ul class="list-none">
    @foreach ($products as $product)
        <li class="flex justify-between">
            <span>{{ $product->menu->name }}</span>
            <span>{{ $product->quantity }} x</span>
        </li>
    @endforeach
</ul>
