<x-dashboard-stat-panel>
    <p class="mb-0 text-secondary">@lang('app.activeInCity')</p>
    <h4 wire:poll.10s class="my-1 text-warning"><i class="icon material-symbols-outlined">group</i> {{$inCityCount}}</h4>
</x-dashboard-stat-panel>
