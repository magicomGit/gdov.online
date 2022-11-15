@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-white px-1 pt-1 h-9 text-lg font-medium transition duration-200 ease-in-out border-b-2 border-yellow-400 hover:text-yellow-500'
            : 'text-white px-1 pt-1 h-9 text-lg font-medium transition duration-200 ease-in-out border-b-2 border-transparent ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
