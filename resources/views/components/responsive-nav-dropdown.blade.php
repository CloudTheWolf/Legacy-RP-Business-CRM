@props(['active', 'align' => 'top', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700', 'dropdownClasses' => '', 'mt' => 'mt-40'])

@php
    $classes = ($active ?? false)
                ? 'relative inline-flex items-center w-full border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 transition duration-150 ease-in-out'
                : 'relative inline-flex items-center w-full border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 transition duration-150 ease-in-out';


@endphp

<div {{ $attributes->merge(['class' => $classes]) }} x-data="{ open: false }"  @click.away="open = false" @close.stop="open = false">
        {{ $trigger }}

    <div x-show="open"
            class="absolute z-50 w-full rounded-md shadow-lg {origin-top {{ $mt }}"
            @click="open = false">
        <div class="w-full {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>

</div>

