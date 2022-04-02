@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-orange-500 text-base font-medium text-orange-500 bg-orange-50 focus:outline-none focus:text-orange-600 focus:bg-orange-50 focus:border-orange-600 transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-orange-300 hover:border-orange-300 focus:outline-none focus:text-orange-400 focus:border-orange-400 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
