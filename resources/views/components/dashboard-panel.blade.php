
<div id="head-card" class="w-1/4 sm:w-1/4 pr-4 pl-4 lg:w-1/4 pr-4 pl-4">
    <div
         {{ $attributes->merge(['class' => 'card radius-10 border-start border-0 border-3']) }}>
        {{ $slot }}
    </div>
</div>
