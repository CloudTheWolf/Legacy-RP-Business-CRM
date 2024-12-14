@props(['active', 'align' => 'top', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700', 'dropdownClasses' => ''])

@php
    $classes = ($active ?? false)
                ? 'relative inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 dark:border-yellow-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'relative inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';

    switch ($width) {
        case '48':
            $width = 'w-48';
            break;
    }

@endphp

<div {{ $attributes->merge(['class' => $classes]) }} x-data="{ open: false }"  @click.away="open = false" @mouseenter="open = ! open" @mouseleave="open = false" @close.stop="open = false">
    {{ $trigger }}

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 {{ $width }} rounded-md shadow-lg {{ $dropdownClasses }} origin-top top-[100%]"
         @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>

</div>

