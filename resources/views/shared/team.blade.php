<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Team') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                        <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800 ">
                            <div>
                                <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Team</h4>
                                <hr class="pb-2">
                            </div>
                            <div class=" grid md:grid-cols-5 grid-cols-2 px-2 pb-1">
                                @foreach($users as $user)
                                <x-profile-card :user="$user"/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
