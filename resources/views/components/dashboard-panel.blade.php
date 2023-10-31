@props(['textclass' => 'yellow-500'])
<div id="head-card">
    <div
         {{ $attributes->merge(['class' => "relative flex flex-col min-w-0 rounded break-words border-300 border-l-4 bg-gray-800"]) }}>
        {{ $slot }}
    </div>
</div>
