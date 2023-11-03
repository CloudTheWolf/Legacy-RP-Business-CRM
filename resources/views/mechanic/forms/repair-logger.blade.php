<div class="px-3 pb-2">

    <form>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="mechanic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <select wire:model="mechanic"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled>Please Select</option>
                    @foreach($mechanics as $mech)
                        <option value="{{$mech->id}}" {{Auth()->id() == $mech->id ? 'selected' : ''}}>{{$mech->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer</label>
                <input
                    type="text"
                    wire:model="customer"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lynette Tsang">
            </div>
        </div>
        <div class="mb-6">
            <div>
                <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                <input wire:model.live="search" type="text" placeholder="Search for a vehicle..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if (sizeof($options) > 0)
                    <ul class="absolute z-10 mt-2 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($options as $option)
                            <li wire:click="selectOption('{{ $option }}')" class="cursor-pointer hover:border-l-2 hover:border-lime-600 hover:bg-gray-600"> {{ $option }}</li>
                        @endforeach
                        <ul>
                    @endif
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-5 sm:grid-cols-1">
            <div>
                <label for="scrap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Scrap')}}</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="scrap">
            </div>
            <div>
                <label for="aluminium" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Aluminium')}}</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="aluminium">
            </div>
            <div>
                <label for="steel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Steel')}}</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="steel">
            </div>
            <div>
                <label for="glass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Glass')}}</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="glass">
            </div>
            <div>
                <label for="rubber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Rubber')}}</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="rubber">
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-5 sm:grid-cols-1">
            <div>
                <label for="adv_kit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Advanced Repair Kit(s)</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="advanced_repair_kit">
            </div>
            <div>
                <label for="oil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motor Oil</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       wire:model.live="motor_oil">
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-6 sm:grid-cols-1">
            <div class="md:col-span-2 sm:col-span-1">
                <label for="finalCost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Final Cost</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       readonly
                       wire:model="final_cost">
            </div>
            <div class="col-span-1">
                <label for="oil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">10% Off</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       readonly
                       wire:model="ten_percent">
            </div>
            <div class="col-span-1">
                <label for="oil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">15% Off</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       readonly
                       wire:model="fifteen_percent">
            </div>
            <div class="col-span-1">
                <label for="oil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">20% Off</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                       readonly
                       wire:model="twenty_percent">
            </div>
            <div class="col-span-1">
                <label for="oil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">25% Off</label>
                <input type="number"
                       min="0"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="0"
                        wire:model="twenty_five_percent">
            </div>
        </div>

        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Log Repair</button>
    </form>

</div>
