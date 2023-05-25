<ul class="list-none">
    @foreach ($menus as $menu)
        <li>{{ $menu->menu->name }}</li>
    @endforeach
</ul>
