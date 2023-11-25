<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                        <span class="material-symbols-outlined">home</span> {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-dropdown :active="request()->routeIs('mechanic*')" :title="__('Mechanic Tools')" :toggle="'mechanicMenu'" >
                        <x-slot name="trigger" :active="request()->routeIs('mechanic*')" >
                            <x-nav-link-parent  href="#" :active="request()->routeIs('mechanic*')">
                                <span class="material-symbols-outlined">service_toolbox</span> {{__('Mechanic Tools')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="mechanicMenu">
                                    <li>
                                        <a href="{{route('mechanic-repair-log-index')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Repair Logger')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('mechanic-all-repairs')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('All Repairs')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('mechanic-purchase-calculator')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Purchase Calculator')}}</a>
                                    </li>
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>

                    <x-nav-dropdown :active="request()->routeIs('tow*')" :title="__('Tow Tools')" :toggle="'towMenu'" :mt="'mt-[8rem]'" >
                        <x-slot name="trigger" :active="request()->routeIs('tow*')" >
                            <x-nav-link-parent  href="#" :active="request()->routeIs('tow*')">
                                <span class="material-symbols-outlined">auto_towing</span> {{__('Tow Tools')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="towMenu">
                                    <li>
                                        <a href="{{route('tow-tracker')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Tow Tracker')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('tow-impound-history')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Impound History')}}</a>
                                    </li>
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>

                    <x-nav-link href="{{ route('team-page') }}" :active="request()->routeIs('team')" wire:navigate>
                        <span class="material-symbols-outlined">groups</span> {{ __('Team') }}
                    </x-nav-link>
                    @if(Auth::user()->IsAdmin == 1)
                    <x-nav-dropdown :active="request()->routeIs('admin*')" :title="__('Admin')" :toggle="'adminMenu'" :mt="'mt-[17rem]'">
                        <x-slot name="trigger" :active="request()->routeIs('admin*')" >
                            <x-nav-link-parent href="#" :active="request()->routeIs('admin*')" wire:navigate>
                                <span class="material-symbols-outlined">admin_panel_settings</span> {{__('Admin')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="adminMenu">
                                    <li>
                                        <a href="{{route('admin-pending-applications')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Job Applications')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin-manage-users')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Manage Users')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin-site-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Site Settings')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin-mechanic-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Mechanic Settings')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin-discord-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Discord Settings')}}</a>
                                    </li>
                                    @if(Config("app.botName") != null)
                                    <li>
                                        <a href="https://c3.cloudthewolf.com/services/bots/restart.php?bot={{Config("app.botName")}}&popup=1" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Restart Bot')}}</a>
                                    </li>
                                    @endif
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        <span class="material-symbols-outlined">schedule</span>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400 text-center">
                                        {{ __('Clock In/Out') }}
                                    </div>

                                    <x-clockin />

                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (!Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ strlen(Auth::user()->avatar_url) > 0 ? Auth::user()->avatar_url : Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>
                            <x-dropdown-link href="{{ route('logout') }}" wire:navigate>
                                {{ __('Log Out') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                <a href="https://github.com/CloudTheWolf/Legacy-RP-Business-CRM" target="_blank">
                                    Version 4.0.2<br>
                                    Developed with 💖 By CloudTheWolf
                                </a>
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                <span class="material-symbols-outlined">home</span> {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Mechanic -->
            <x-responsive-nav-dropdown :active="request()->routeIs('mechanic*')" :title="__('Mechanic Tools')" :toggle="'mechanicMenu'" >
                <x-slot name="trigger" :active="request()->routeIs('mechanic*')" >
                    <x-responsive-nav-link-parent :active="request()->routeIs('mechanic*')">
                        <span class="material-symbols-outlined">service_toolbox</span> {{__('Mechanic Tools')}}
                    </x-responsive-nav-link-parent>

                    <x-slot name="content">
                        <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="mechanicMenu">
                            <li>
                                <a href="{{route('mechanic-repair-log-index')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Repair Logger')}}</a>
                            </li>
                            <li>
                                <a href="{{route('mechanic-all-repairs')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('All Repairs')}}</a>
                            </li>
                            <li>
                                <a href="{{route('mechanic-purchase-calculator')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Purchase Calculator')}}</a>
                            </li>
                        </ul>
                    </x-slot>
                </x-slot>
            </x-responsive-nav-dropdown>

            <!-- Tow -->
            <x-responsive-nav-dropdown :active="request()->routeIs('tow*')" :title="__('Tow Tools')" :toggle="'towMenu'" >
                <x-slot name="trigger" :active="request()->routeIs('tow*')" >
                    <x-responsive-nav-link-parent :active="request()->routeIs('tow*')">
                        <span class="material-symbols-outlined">auto_towing</span> {{__('Tow Tools')}}
                    </x-responsive-nav-link-parent>

                    <x-slot name="content">
                        <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="towMenu">
                            <li>
                                <a href="{{route('tow-tracker')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Tow Tracker')}}</a>
                            </li>
                            <li>
                                <a href="{{route('tow-impound-history')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Impound History')}}</a>
                            </li>
                        </ul>
                    </x-slot>
                </x-slot>
            </x-responsive-nav-dropdown>

            <!-- Team -->
            <x-responsive-nav-link href="{{ route('team-page') }}" :active="request()->routeIs('team')" wire:navigate>
                <span class="material-symbols-outlined">groups</span> {{ __('Team') }}
            </x-responsive-nav-link>
            @if(Auth::user()->IsAdmin == 1)
            <!-- Admin -->
            <x-responsive-nav-dropdown :active="request()->routeIs('admin*')" :title="__('Admin')" :toggle="'adminMenu'" :mt="'mt-[17rem]'">
                <x-slot name="trigger" :active="request()->routeIs('admin*')" >
                    <x-responsive-nav-link-parent :active="request()->routeIs('admin*')">
                        <span class="material-symbols-outlined">admin_panel_settings</span> {{__('Admin')}}
                    </x-responsive-nav-link-parent>

                    <x-slot name="content">
                        <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="adminMenu">
                            <li>
                                <a href="{{route('admin-pending-applications')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Job Applications')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin-manage-users')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Manage Users')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin-site-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Site Settings')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin-mechanic-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Mechanic Settings')}}</a>
                            </li>
                            <li>
                                <a href="{{route('admin-discord-settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:navigate>{{__('Discord Settings')}}</a>
                            </li>
                            @if(Config("app.botName") != null)
                            <li>
                                <a href="https://c3.cloudthewolf.com/services/bots/restart.php?bot={{Config("app.botName")}}&popup=1" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" >{{__('Restart Bot')}}</a>
                            </li>
                            @endif
                        </ul>
                    </x-slot>
                </x-slot>
            </x-responsive-nav-dropdown>
            @endif

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <x-responsive-nav-link href="{{ route('logout') }}" wire:navigate>
                    {{ __('Log Out') }}
                </x-responsive-nav-link>


                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <div class="block px-4 py-2 text-xs text-gray-400 text-center">
                    {{ __('Clock In/Out') }}
                </div>

                <x-clockin />

                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    <a href="https://github.com/CloudTheWolf/Legacy-RP-Business-CRM" target="_blank">
                        Version 4.0.2<br>
                        Developed with 💖 By CloudTheWolf
                    </a>
                </div>

            </div>
        </div>
    </div>
</nav>
