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
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <span class="material-symbols-outlined">home</span> {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-dropdown :active="request()->routeIs('mechanic*')" :title="__('Mechanic Tools')" :toggle="'mechanicMenu'" >
                        <x-slot name="trigger" :active="request()->routeIs('mechanic*')" >
                            <x-nav-link-parent :active="request()->routeIs('mechanic*')">
                                <span class="material-symbols-outlined">service_toolbox</span> {{__('Mechanic Tools')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="mechanicMenu">
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Repair Logger')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('All Repairs')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Purchase Calculator')}}</a>
                                    </li>
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>

                    <x-nav-dropdown :active="request()->routeIs('tow*')" :title="__('Tow Tools')" :toggle="'towMenu'" :mt="'mt-[8rem]'" >
                        <x-slot name="trigger" :active="request()->routeIs('tow*')" >
                            <x-nav-link-parent :active="request()->routeIs('tow*')">
                                <span class="material-symbols-outlined">auto_towing</span> {{__('Tow Tools')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="towMenu">
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Tow Tracker')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Impound History')}}</a>
                                    </li>
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('team')">
                        <span class="material-symbols-outlined">groups</span> {{ __('Team') }}
                    </x-nav-link>

                    <x-nav-dropdown :active="request()->routeIs('admin*')" :title="__('Admin')" :toggle="'adminMenu'" :mt="'mt-[17rem]'">
                        <x-slot name="trigger" :active="request()->routeIs('admin*')" >
                            <x-nav-link-parent :active="request()->routeIs('admin*')">
                                <span class="material-symbols-outlined">admin_panel_settings</span> {{__('Admin')}}
                            </x-nav-link-parent>

                            <x-slot name="content">
                                <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="adminMenu">
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Job Applications')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Add User')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Manage Users')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Site Settings')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Mechanic Settings')}}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Restart Bot')}}</a>
                                    </li>
                                </ul>
                            </x-slot>
                        </x-slot>
                    </x-nav-dropdown>

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
                                        <!--<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>-->
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

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
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
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
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
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Repair Logger')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('All Repairs')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Purchase Calculator')}}</a>
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
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Tow Tracker')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Impound History')}}</a>
                            </li>
                        </ul>
                    </x-slot>
                </x-slot>
            </x-responsive-nav-dropdown>

            <!-- Team -->
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('team')">
                <span class="material-symbols-outlined">groups</span> {{ __('Team') }}
            </x-responsive-nav-link>
            <!-- Admin -->
            <x-responsive-nav-dropdown :active="request()->routeIs('admin*')" :title="__('Admin')" :toggle="'adminMenu'" :mt="'mt-[17rem]'">
                <x-slot name="trigger" :active="request()->routeIs('admin*')" >
                    <x-responsive-nav-link-parent :active="request()->routeIs('admin*')">
                        <span class="material-symbols-outlined">admin_panel_settings</span> {{__('Admin')}}
                    </x-responsive-nav-link-parent>

                    <x-slot name="content">
                        <ul class="text-sm text-gray-700 dark:text-gray-400" aria-labelledby="adminMenu">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Job Applications')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Add User')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Manage Users')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Site Settings')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Mechanic Settings')}}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('Restart Bot')}}</a>
                            </li>
                        </ul>
                    </x-slot>
                </x-slot>
            </x-responsive-nav-dropdown>

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
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>


                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <div class="block px-4 py-2 text-xs text-gray-400 text-center">
                    {{ __('Clock In/Out') }}
                </div>

                <x-clockin />


            </div>
        </div>
    </div>
</nav>
