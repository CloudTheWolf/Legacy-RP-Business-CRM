<div>
    <livewire:livewire-pie-chart
        key="{{ $topFiveThisMonth->reactiveKey() }}"
        :pie-chart-model="$topFiveThisMonth"
    />
</div>
