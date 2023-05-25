<ul class="list-none">
    @foreach ($products as $product)
        <li>{{ $product->quantity }}</li>
    @endforeach
</ul>
