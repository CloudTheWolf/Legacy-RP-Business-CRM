<div class="px-3 pb-2">
    <form wire:submit="save">

        <div class="grid gap-6 mb-6 md:grid-cols-5">
            <div>
                <label for="scrap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Scrap')}}</label>
                <input type="text"
                       pattern="[0-9]*"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="scrap">
            </div>
            <div>
                <label for="aluminium" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Aluminium')}}</label>
                <input type="text"
                       pattern="[0-9]*"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="aluminium">
            </div>
            <div class="col-span-1">
                <label for="steel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Steel')}}</label>
                <input type="text"
                       pattern="[0-9]*"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="steel">
            </div>
            <div class="col-span-1">
                <label for="glass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Glass')}}</label>
                <input type="text"
                       pattern="[0-9]*"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="glass">
            </div>
            <div class="col-span-1">
                <label for="rubber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Rubber')}}</label>
                <input type="text"
                       pattern="[0-9]*"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="rubber">
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-6 sm:grid-cols-1">
            <div class="md:col-span-2 sm:col-span-1">
                <label for="finalCost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Cost</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       readonly
                       wire:model="final_cost">
            </div>
        </div>

        <div class="grid grid-cols-5">
            <div class="md:col-span-1 col-span-5 mb-2">
                <button wire:loading.attr="disabled" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
            </div>
            <div class="md:col-span-1 col-span-5">
                <button wire:loading.attr="disabled" wire:click="SetToZero" class="text-red-700 hover:text-white bg-transparent border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Reset</button>
            </div>
            @if(session('save-success'))
                <div class="col-span-2" x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 3000)">
                    <div id="alert"
                         x-show="showAlert"
                         x-transition:leave="transition duration-500 ease-in-out transform"
                         @click="showAlert = false"
                         class="relative flex items-center p-1 text-white bg-green-600 rounded-lg transition-opacity ease-in duration-700" role="alert">
                        <span class="material-symbols-outlined">save</span>
                        <div class="ml-3 text-sm font-medium">
                            {{ session('save-success') }}
                        </div>
                    </div>
                </div>
            @endif
            @if(session('save-error'))
                <div class="col-span-2" x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 9000)">
                    <div id="alert"
                         x-show="showAlert"
                         x-transition:leave="transition duration-500 ease-in-out transform"
                         @click="showAlert = false"
                         class="relative flex items-center p-1 text-white bg-red-600 rounded-lg transition-opacity ease-in duration-700" role="alert">
                        <span class="material-symbols-outlined">save</span>
                        <div class="ml-3 text-sm font-medium">
                            {{ session('save-error') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>

</div>
