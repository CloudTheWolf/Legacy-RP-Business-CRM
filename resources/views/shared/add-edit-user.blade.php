<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="py-3">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid grid-cols-1 gap-4 content-center">
                        <div class="relative flex flex-col min-w-4xl rounded break-words bg-gray-800">
                            <div>
                                <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Manage User</h4>
                                <hr class="pb-2">
                            </div>
                            <div class="relative px-2 pb-1 pt-4 w-full content-center items-center">
                                <livewire:shared.forms.add-edit-user :id="$id"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
