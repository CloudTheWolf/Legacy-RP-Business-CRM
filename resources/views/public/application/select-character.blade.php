<x-guest-no-bg-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />

        </x-slot>
        <p class="text-center text-white">
            Enter your CID
        </p>
        <hr class="py-1" />
        <form method="POST" action="{{ route('mechanic-application-form') }}">
            @csrf

            <div>
                <x-label for="cid" value="{{ __('Enter CID') }}" />
                <x-input id="cid" class="block mt-1 w-full" type="text" name="cid" :value="old('cid')" required autofocus />
            </div>

            <div class="columns-1 mt-2">
                <button type='submit' class='items-center text-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest dark:hover:bg-white dark:focus:bg-white dark:active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full'>
                    {{ __('Continue') }}
                </button>

            </div>
        </form>
    </x-authentication-card>
</x-guest-no-bg-layout>
