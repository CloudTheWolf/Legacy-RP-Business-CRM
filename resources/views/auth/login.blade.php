<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

            <div>
                <x-label for="email" value="{{ __('Username') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                  <!--<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>-->
                @endif


            </div>
            <div class="grid md:grid-cols-3 grid-cols-1 content-center">
                <div class="w-full col-span-1 mb-2">
                    <a href="{{route("auth.steam")}}" class="bg-black hover:bg-black text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-black hover:border-white rounded"><i class="text-lg lni lni-steam"></i> Steam</a>
                </div>
                <div class="md:w-full w-fit">
                    <a href="{{route("auth.discord")}}" class="bg-[#7289da] hover:bg-[#98abed] text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-[#7289da] hover:border-[#98abed] rounded"><i class="text-lg lni lni-discord"></i> Discord</a>
                </div>
                <x-button class="ml-1 md:w-full w-1/2 md:mt-0 mt-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
