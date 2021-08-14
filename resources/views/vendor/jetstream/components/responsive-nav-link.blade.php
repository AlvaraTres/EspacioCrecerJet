@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-green-900 text-white block px-3 py-2 rounded-md text-base font-medium'
            : 'text-white hover:bg-blue-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
