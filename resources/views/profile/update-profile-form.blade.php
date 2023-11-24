<x-form-section submit="updateProfile">
    <x-slot name="title">
        {{ __('Update Profile') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your profile details!') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" autocomplete="none" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Cell Phone') }}" />
            <x-input id="password" type="text" pattern="^[0-9]{3}-[0-9]{4}$" class="mt-1 block w-full" wire:model="state.cell" autocomplete="none" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="towID" value="{{ __('Tow Plates') }}" />
            <x-input id="towID" type="text" pattern="[a-zA-Z0-9;,]+" class="mt-1 block w-full" wire:model="state.towID" autocomplete="none" />
            <x-input-error for="towID" class="mt-2" />
            <x-input-error for="towID" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Discord ID') }}" />
            <x-input id="password" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model="state.discord" readonly />
            <div class="mt-1 md:w-full w-fit">
                <a href="{{route("auth.discord-profile-link")}}" class="bg-[#7289da] hover:bg-[#98abed] text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-[#7289da] hover:border-[#98abed] rounded"><i class="text-lg lni lni-discord"></i> Link Account</a>
            </div>
            <x-input-error for="password" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
