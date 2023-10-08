<div>
    <livewire:livewire-pie-chart
        key="{{ $topFiveLastMonth->reactiveKey() }}"
        :pie-chart-model="$topFiveLastMonth"
    />
</div>
