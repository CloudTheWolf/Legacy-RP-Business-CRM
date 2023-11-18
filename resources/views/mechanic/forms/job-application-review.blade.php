<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 bg-white dark:bg-gray-800 sm:p-6 shadow rounded-md content-center text-center">
        <h3><span class="text-white text-center text-lg">{{ __('Personal Details') }}</span></h3>
        <hr>
        <p><span class="text-white text-center">{{ __('Name') }}: {{$this->name}}</span></p>
        <p><span class="text-white text-center">{{ __('Cell') }}: {{$this->cell}}</span></p>
        <p><span class="text-white text-center">{{ __('E-Mail') }}: {{$this->discord}}</span></p>
        <hr>
        <h3><span class="text-white text-center">{{ __('Tell us a little about yourself') }}</span></h3>
        <hr>
        <p class="text-white text-center" style="white-space: pre-wrap;">
            {{$this->about}}
        </p>
        <hr>
        <p><span class="text-white text-center">{{ __('Tell us why you want a job at '.config('app.companyName').' and why we should hire you!') }}</span></p>
        <hr>
        <p class="text-white text-center" style="white-space: pre-wrap;">
            {{$this->why}}
        </p>
        <hr>
        <p><span class="text-white text-center">{{ __('Tell us about your Criminal Record') }}</span></p>
        <hr>
        <p class="text-white text-center" style="white-space: pre-wrap;">
            {{$this->record}}
        </p>
        <p class="text-white text-center" style="white-space: pre-wrap;">
            I <span class="font-bold">{{$this->gang ? 'DO' : 'DO NOT'}}</span> have gang affiliations that may impact my employment.
        </p>
    </div>
    <hr>
    <form method="post">
    @csrf
    <div class="px-4 bg-white dark:bg-gray-800 sm:p-6 shadow rounded-md content-center text-center">
        <label class="text-white" for="email">Username</label>
        <input type="text" wire:model="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
    <div class="px-4 bg-white dark:bg-gray-800 sm:p-6 shadow rounded-md content-center text-center">
        <label class="text-white" for="role">Position</label>
            <select id="role" wire:model="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Tow Driver">Tow Driver</option>
                <option value="Intern Mechanic">Intern Mechanic</option>
                <option value="Mechanic">Mechanic</option>
                <option value="Lead Mechanic">Lead Mechanic</option>
                <option value="Expert Mechanic">Expert Mechanic</option>
                <option value="Veteran Mechanic">Veteran Mechanic</option>
                <option value="Trainer">Trainer</option>
                <option value="Manager">Manager</option>
                <option value="Veteran Manager">Veteran Manager</option>
                <option value="Boss">Boss</option>
            </select>
        <x-static-action-message class="mr-3  bg-red-800 text-white" on="rejected">
            {{ __('Application Rejected.') }}
        </x-static-action-message>

        <x-static-action-message class="mr-3 bg-green-800 text-white" on="accepted">
            {{ __('Application Accepted.') }}
        </x-static-action-message>

    </div>
    <div class="col-span-2">
        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">Accept Application</button>
    </div>
    <div class="col-span-2">
        <button wire:click="reject" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 w-full">Reject Application</button>
    </div>
    </form>
</div>
