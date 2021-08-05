@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-green-900 text-white px-3 py-2 rounded-md text-sm font-medium'
            : 'text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
