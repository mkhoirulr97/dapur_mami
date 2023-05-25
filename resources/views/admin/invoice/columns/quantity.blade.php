<ul class="list-none">
    @foreach ($menus as $menu)
        <li>{{ $menu->quantity }}</li>
    @endforeach
</ul>
