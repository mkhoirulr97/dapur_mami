@props(['name' => '', 'icon' => '', 'route' => '', 'active' => false])

<li>
    <a href="{{ $route }}"
        class="flex items-center p-3 font-normal text-gray-900 rounded-md dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ $active == true ? 'bg-primary text-white shadow-sm hover:bg-secondary' : '' }}">
        <i
            class="{{ $icon }} w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ $active == true ? 'text-white' : '' }}"></i>
        <span class="ml-3">{{ $name }}</span>
    </a>
</li>
