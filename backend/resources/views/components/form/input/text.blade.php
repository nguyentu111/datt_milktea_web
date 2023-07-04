@props([
    'name',
    'type' => 'text',
    'placeholder' => null,
])

<input {{ $attributes->merge(['type' => $type,
        'placeholder' => $placeholder ,
        'class' => "pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6",
        'name' => $name,
        'id' => $name]) }}>