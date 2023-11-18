<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Repair Logger') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden rounded-lg">
                <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 col-span-1">
                        <div>
                            <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Tow Tracker</h4>
                            <p class="text-md text-gray-200 text-center pb-3 pb-1">Keep a tally of what you do while towing!</p>
                            <hr class="pb-2">
                        </div>
                        <livewire:mechanic.forms.tow-tracker/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden rounded-lg">
                <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                    <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 col-span-1">
                        <div>
                            <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Recent Impounds</h4>
                            <hr class="pb-2">
                        </div>
                        <livewire:mechanic.tables.recent-impound/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
