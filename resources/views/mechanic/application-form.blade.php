<x-guest-no-bg-layout>
    <x-application-form>
        <x-slot name="logo">
            <x-authentication-card-logo />

        </x-slot>

        <h3 class="text-center text-white">
            Application Form
        </h3>
        <hr class="py-2">
        <p class="pb-2 text-sm">
            All Data on this form, with the exception of Email / Email ID (Discord Name / ID) and Passport ID (Steam ID), MUST be filled "In Character".
            We Do not want your OOC Details, please don't dox yourself.
        </p>
        <hr class="py-1" />
        <form method="POST" action="{{route('mechanic-application-form-submit')}}">
            @csrf

            <div  x-data="{ userTimezone: '' }" x-init="userTimezone = getUserTimezone()">
                <x-label for="timezone" value="{{ __('Your Timezone') }}" />
                <x-input id="timezone" class="block mt-1 w-full" type="text" name="timezone" x-bind:value="userTimezone" required readonly/>
            </div>

            <div>
                <x-label for="name" value="{{ __('Full Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$name}}" required readonly/>
            </div>

            <div >
                <x-label for="cid" value="{{ __('CID') }}" />
                <x-input id="cid" class="block mt-1 w-full" type="text" name="cid" value="{{$cid}}" required readonly/>
            </div>
            <div class="pb-2">
                <x-label for="cell" value="{{ __('Cell Phone') }}" />
                <x-input id="cell" class="block mt-1 w-full" type="text" name="cell" value="{{$cell}}" required readonly/>
            </div>
            <hr class="py-1" />
            <div>
                <x-label for="discord" value="{{ __('Email') }}" />
                <x-input id="discord" class="block mt-1 w-full" type="text" name="discord" value="{{$discordName}}" required readonly/>
            </div>
            <div>
                <x-label for="discordId" value="{{ __('Email ID') }}" />
                <x-input id="discordId" class="block mt-1 w-full" type="text" name="discordId" value="{{Session::get('discordId')}}" required readonly/>
            </div>
            <div class="pb-1">
                <x-label for="steam" value="{{ __('Passport ID') }}" />
                <x-input id="steam" class="block mt-1 w-full" type="text" name="steam" value="{{Session::get('steamID')}}" required readonly/>
            </div>
            <hr class="py-1" />
            <div class="pb-1">
                <x-label for="about" value="{{ __('Tell us a little about yourself.') }}" />
                <textarea id="about" maxlength="200" name="about" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
            </div>
            <div class="pb-1">
                <x-label for="why" value="{{ __('Tell us why you want a job at '.config('app.companyName').' and why we should hire you?') }}" />
                <textarea id="why" maxlength="200" name="why" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
            </div>
            <div class="pb-1">
                <x-label for="record" value="{{ __('Tell us about your Criminal Record!') }}" />
                <textarea id="record" maxlength="200" name="record" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>My Last Arrest Was {{$lastArrest}}</textarea>
            </div>
            <div class="pb-1">
                <x-label for="gang" value="{{ __('Do you have any gang ties, or affiliations that may affect your employment?') }}" />
                <div class="flex items-center col col-span-1">
                    <input checked id="default-radio-1" type="radio" value="0" name="gang" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                </div>
                <div class="flex items-center col col-span-1">
                    <input id="default-radio-2" type="radio" value="1" name="gang" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yes</label>
                </div>
            </div>
            <div class="columns-1 mt-2">
                <button type='submit' class='items-center text-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest dark:hover:bg-white dark:focus:bg-white dark:active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full'>
                    {{ __('Continue') }}
                </button>

            </div>
        </form>
    </x-application-form>
    @section('js_page')
        <script>
            function getUserTimezone() {
                return Intl.DateTimeFormat(undefined, {timeZoneName: 'long'}).resolvedOptions().timeZone;
            }
        </script>
    @endsection
</x-guest-no-bg-layout>

