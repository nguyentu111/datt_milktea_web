@props([
'type' => 'text',
])

<button {{ $attributes->merge([ 'type' => $type, 'class' => "text-black inline-flex items-center gap-x-2 rounded-md bg-primary px-3.5 py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"]) }} style="color: white">
  {{ $slot }}

</button>

{{-- <button {{ $attributes->merge([ 'type' => $type, 'class' => "text-black inline-flex items-center gap-x-2 rounded-md bg-primary px-3.5 py-2.5 text-sm font-semibold shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"]) }} style="color: white">
{{ $slot }}

</button> --}}