<div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="app_name" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
        <label for="app_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Application Name</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <input wire:model="company_name" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
        <label for="company_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company Name</label>
    </div>

    <div class="relative z-0 w-full mb-6">
        <select wire:model="branding_dir" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent focus:bg-gray-800 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
            <option disabled="" readonly="" selected="">Please Select</option>
            <optgroup label="Mechanic Shop">
                <option selected="" value="harmony">Harmony</option>
                <option value="hayes">Hayes</option>
                <option value="lost">Lost</option>
                <option value="mpar">Mirror Park</option>
                <option value="mosleys">Mosley's</option>
                <option value="pbay">Paleto Bay</option>
                <option value="2g">Second Gear</option>
            </optgroup>
            <optgroup label="Bars/Clubs/Arcade">
                <option value="bahama">Bahama Mama</option>
                <option value="steak1">Madrazo's Steak House</option>
                <option value="splitsides">Split Sides</option>
                <option value="tll">Tequi-la-la</option>
                <option value="vg">Videogeddon</option>
                <option value="yellowjack">Yellow Jack Inn</option>
            </optgroup>
            <optgroup label="Gangs">
                <option value="aod">Angels Of Death</option>
                <option value="sol">SOL</option>
            </optgroup>
            <optgroup label="Law">
                <option value="doj">DOJ</option>
            </optgroup>
        </select>
        <label for="branding_dir" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">Branding Style</label>
    </div>
    <div class="relative z-0 w-full mb-6">
        <select wire:model="site_mode" class="block py-2.5 px-0 w-full text-sm bg-transparent focus:bg-gray-800 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
            <option value="DOJ">DOJ</option>
            <option value="Mechanic">Mechanic</option>
            <option value="Motorcycle Club">Motorcycle Club</option>
            <option value="Shop">Shop</option>
        </select>
        <label for="site_mode" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400  duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">Site Mode</label>
    </div>

    <div class="relative z-0 w-full mb-6">
    </div>
    <div class="relative z-0 w-full mb-6">
        <button wire:click="save_settings" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900 w-full">Save</button>
        <x-action-message class="flex flex-col items-center bg-green-600 rounded-lg" on="saved">
            {{ __('Settings Saved.') }}
        </x-action-message>
    </div>

</div>
