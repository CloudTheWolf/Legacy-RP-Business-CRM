@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-left text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
                : 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-gray-500 dark:text-gray-400 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out';
    $xclasses = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}  @click="open = ! open">
    {{$slot}}
    <svg class="absolute w-3.5 h-3.5 ml-2.5 right-3 top-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
</a>
