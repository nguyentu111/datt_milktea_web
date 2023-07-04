@props([
    'title' => '',
    'route' => ''
])
<li>
<a href="{{ $route }}" style="color: black;" class="bg-white hover:bg-primary-400 flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
    {{ $slot }}
    {{ $title }}
</a>
</li>