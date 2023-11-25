<div class="px-2 py-2 min-h-[250px]">
    <livewire:livewire-line-chart
        key="{{ $chart->reactiveKey() }}"
        :line-chart-model="$chart"
    />
</div>
