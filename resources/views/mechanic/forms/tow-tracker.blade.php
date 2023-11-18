<div class="px-3 pb-2">
    <form wire:submit="save">
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div class="col-span-1">
                <div class="content-center">
                <input wire:model.live="local" type="text" placeholder="0" pattern="[0-9]*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2">

                    <button wire:click="add_local" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center bg-green-700 text-white hover:bg-green-900 mr-2 mb-2 w-full h-16" tabindex="-1">
                        <span class="material-symbols-outlined">person</span>Add Local
                    </button>
                </div>
            </div>
            <div class="col-span-1">
                <div class="content-center">
                    <input wire:model.live="citizen" type="text" placeholder="0" pattern="[0-9]*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2">
                <button wire:click="add_player" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center bg-blue-500 text-white hover:bg-blue-600 mr-2 mb-2 w-full h-16" tabindex="-1">
                    <span class="material-symbols-outlined">directions_car</span>Add Citizen
                </button>
                </div>
            </div>
            <div class="col-span-1">
                <div class="content-center">
                    <input wire:model.live="pd_ems" type="text" placeholder="0" pattern="[0-9]*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2">
                <button wire:click="add_pd_ems" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center bg-red-500 text-white hover:bg-red-700 mr-2 mb-2 w-full h-16" tabindex="-1">
                    <span class="material-symbols-outlined">local_police</span>Add Emergency Services
                </button>
                </div>
            </div>
            <div class="col-span-1">
                <div class="content-center">
                    <input wire:model.live="help" type="text" placeholder="0" pattern="[0-9]*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2">
                    <button wire:click="add_help" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center bg-purple-500 text-white hover:bg-purple-700 mr-2 mb-2 w-full h-16" tabindex="-1">
                        <span class="material-symbols-outlined">question_mark</span>Add General Help
                    </button>
                </div>
            </div>
        </div>
        <div class="grid gap-6 mb-6 grid-cols-4">
            <div class="col-span-1">
                <div class="content-center">
                    <button wire:click="reset_tally" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center border border-yellow-300 text-yellow-300 hover:border-yellow-600 hover:text-yellow-600 mr-2 mb-2 w-1/2" tabindex="-1">
                        <span class="material-symbols-outlined">device_reset</span>Reset
                    </button>
                </div>
            </div>
            <div class="md:col-span-2">
                @if(session('log-success'))
                    <div class="col-span-2" x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 3000)">
                        <div id="alert"
                             x-show="showAlert"
                             x-transition:leave="transition duration-500 ease-in-out transform"
                             @click="showAlert = false"
                             class="relative flex items-center p-1 text-white bg-green-600 rounded-lg transition-opacity ease-in duration-700" role="alert">
                            <span class="material-symbols-outlined">save</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('log-success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if(session('log-warn'))
                    <div class="col-span-2" x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 9000)">
                        <div id="alert"
                             x-show="showAlert"
                             x-transition:leave="transition duration-500 ease-in-out transform"
                             @click="showAlert = false"
                             class="relative flex items-center p-1 text-white bg-yellow-600 rounded-lg transition-opacity ease-in duration-700" role="alert">
                            <span class="material-symbols-outlined">save</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('log-warn') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if(session('log-error'))
                    <div class="col-span-2" x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 9000)">
                        <div id="alert"
                             x-show="showAlert"
                             x-transition:leave="transition duration-500 ease-in-out transform"
                             @click="showAlert = false"
                             class="relative flex items-center p-1 text-white bg-red-600 rounded-lg transition-opacity ease-in duration-700" role="alert">
                            <span class="material-symbols-outlined">save</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('log-error') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-span-1">
                <div class="content-center">
                    <button wire:click="log_tally" type="button" class=" content-center text-center rounded-lg text-sm py-2.5 items-center border border-green-400 text-green-400 hover:bg-green-600 hover:text-white mr-2 mb-2 w-2/3 h-16" tabindex="-1">
                        <span class="material-symbols-outlined">send</span><br>Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
