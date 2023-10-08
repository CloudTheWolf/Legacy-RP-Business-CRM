
<div id="head-card" class="col-3 col-sm-3 col-lg-3">
    <div
         {{ $attributes->merge(['class' => 'card radius-10 border-start border-0 border-3']) }}>
        {{ $slot }}
    </div>
</div>
