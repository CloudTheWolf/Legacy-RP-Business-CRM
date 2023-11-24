<div>
    <x-action-message class="flex flex-col items-center bg-red-600 rounded-lg" on="lookup_error">
        <span class="material-symbols-outlined">emergency_home</span> {{ __('Error Searching by CID.') }}
    </x-action-message>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="full_name" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
        <label for="full_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="username" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer {{!$is_new ? 'cursor-not-allowed' : ''}}" placeholder=" " {{!$is_new ? 'readonly' : ''}} />
        <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="cid" pattern="[0-9]*" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer {{!$is_new ? 'cursor-not-allowed' : ''}}" placeholder=" " {{!$is_new ? 'readonly' : ''}} />
        <label for="cid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Citizen ID</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="steamId" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer {{!$is_new ? 'cursor-not-allowed' : ''}}" placeholder=" " />
        <label for="steamId" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Steam ID</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="cell" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
        <label for="cell" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cell Phone</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="password" type="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
        <label for="cell" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
    </div>

    <div class="relative z-0 w-full mb-6">
        <select wire:model.live="role" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent focus:bg-gray-800 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
            <option selected="" disabled="">Please Select</option>
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
            <option value="IT Support">IT Support</option>
        </select>
        <label for="discord_auto_invite" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">Automatically add user to Discord when accepting job application?</label>
    </div>

    <div class="relative z-0 w-full mb-6">
        <label class="relative inline-flex items-center me-5 cursor-pointer">
            <input wire:model="admin" type="checkbox" value="1" class="sr-only peer" @if($admin == 1) checked @endif>
            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Administrator</span>
        </label>

        <label class="relative inline-flex items-center me-5 cursor-pointer">
            <input wire:model="disable" type="checkbox" value="1" class="sr-only peer" @if($disable == 1) checked @endif>
            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Disable Account</span>
        </label>
    </div>
    <div class="relative z-0 w-full mb-6">
    </div>
    <div class="relative z-0 w-full mb-6">
        <button @if($is_new) wire:click="add_user" @else wire:click="save_user" @endif type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900 w-full">@if($is_new == 1) Add New User @else Save User @endif</button>
        <x-action-message class="flex flex-col items-center bg-green-600 rounded-lg" on="saved">
            {{ __('User Saved.') }}
        </x-action-message>
    </div>

    @if($is_new)
        <div class="relative z-0 w-full mb-6">
            <button wire:click="cid_lookup" type="button" class="text-white hover:text-gray-800 bg-transparent border border-yellow-500 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 w-full">CID Lookup</button>
        </div>

    @endif
</div>
