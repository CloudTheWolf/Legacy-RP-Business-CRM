<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden rounded-lg">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                    <livewire:mechanic.dashboard.self.repair-count />
                    <livewire:mechanic.dashboard.stats.total-income />
                    <livewire:shared.dashboard.stats.on-duty />
                    <livewire:shared.dashboard.stats.in-city />
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 py-2">
            <div class="bg-transparent overflow-hidden rounded-lg">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 col-span-2">
                        <livewire:mechanic.dashboard.graphs.sales-graph lazy/>
                    </div>
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 col-span-1">
                        <livewire:shared.dashboard.tables.on-duty/>
                    </div>
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 col-span-1">
                        <livewire:mechanic.dashboard.tables.stats/>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 py-2">
            <div class="bg-transparent overflow-hidden rounded-lg">
                <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                        <livewire:mechanic.dashboard.graphs.all-time lazy/>
                    </div>
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                        <livewire:mechanic.dashboard.graphs.last-month lazy/>
                    </div>
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                        <livewire:mechanic.dashboard.graphs.this-month lazy/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
