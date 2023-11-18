<x-guest-no-bg-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />

        </x-slot>
        <p class="text-center text-white">
            Welcome <br>
            To continue with an application, please login <br>
            Via Discord
        </p>
        <hr class="py-1" />
        <div class="text-center bg-[#7289da] hover:bg-[#98abed] text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-[#7289da] hover:border-[#98abed] rounded">
        <a href="{{route("auth.discord-apply")}}" class=""><i class="text-lg lni lni-discord"></i> Login With Discord</a>
        </div>
    </x-authentication-card>
</x-guest-no-bg-layout>
