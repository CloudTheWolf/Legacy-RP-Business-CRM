<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row-cols-4">
                    <x-dashboard-stat-panel :icon="'bx bxs-wrench'" :class="'border-info'">
                        <p class="mb-0 text-secondary">{{__('Total Repairs')}}</p>
                        <h4 class="my-1 text-info"><i class="icon material-symbols-outlined">home_repair_service</i> 0 </h4>
                    </x-dashboard-stat-panel>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
