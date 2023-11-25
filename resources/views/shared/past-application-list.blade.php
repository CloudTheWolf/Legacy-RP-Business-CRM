<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pending Applications') }}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                        <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                            <div class="flex flex-col px-2 py-1 content-center items-center">
                                <a href="{{route('admin-pending-applications')}}" wire:navigate  class="bg-transparent text-violet-500 border border-violet-700 hover:text-white hover:bg-violet-700 hover:border-transparent focus:outline-none focus:ring-4 focus:ring-violet-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 my-2 dark:focus:ring-violet-900"><span class="flex flex-col material-symbols-outlined">pending</span>Pending Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                        <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 ">
                            <div>
                                <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Pending Applications</h4>
                                <hr class="pb-2">
                            </div>
                            <div class="grid md:grid-cols-5 grid-cols-2 px-2 pb-1">
                                @foreach($applications as $application)
                                    <x-application-card :application="$application"/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
