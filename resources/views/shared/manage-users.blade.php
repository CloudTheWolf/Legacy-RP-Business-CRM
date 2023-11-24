<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                        <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                            <div class="flex flex-col md:grid md:grid-cols-6 px-2 py-1 content-center items-center">
                                <div class="md:col-span-2"></div>
                                <a href="{{route('admin-add-user')}}" class="col-span-1 bg-transparent text-green-700 border border-green-700 hover:text-white hover:bg-green-700 hover:border-transparent focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 my-2 dark:focus:ring-green-900" wire:navigate><span class="flex flex-col material-symbols-outlined">person_add</span>Add New User</a>
                                <a href="{{route('admin-manage-disabled-users')}}" class="col-span-1 bg-transparent text-cyan-700 border border-cyan-700 hover:text-white hover:bg-cyan-700 hover:border-transparent focus:outline-none focus:ring-4 focus:ring-cyan-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 my-2 dark:focus:ring-green-900" wire:navigate><span class="flex flex-col material-symbols-outlined">person_off</span>Disabled Accounts</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent overflow-hidden rounded-lg">
                    <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-4 sm:content-center	md:content-normal">
                        <div class="relative flex flex-col min-w-0 rounded break-words bg-gray-800">
                            <div>
                                <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase text-center pb-3 pt-3">Users</h4>
                                <hr class="pb-2">
                            </div>
                            <div class="relative px-2 pb-1 content-center items-center">
                                <div class=" grid md:grid-cols-5 grid-cols-2 px-2 pb-1">
                                    @foreach($users as $user)
                                        <x-profile-card-admin :user="$user"/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
