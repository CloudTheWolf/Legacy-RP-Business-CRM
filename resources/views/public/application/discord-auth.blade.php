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
        <?php if($application_state == "Yes") {
        ?>
        <div class="text-center bg-[#7289da] hover:bg-[#98abed] text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-[#7289da] hover:border-[#98abed] rounded">
        <a href="{{route("auth.discord-apply")}}" class=""><i class="text-lg lni lni-discord"></i> Login With Discord </a>
        </div>
        <?php
        }  else {
        ?>
        <div class="text-center bg-[#dd2200] hover:bg-[#dd2200] text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-[#dd2200] hover:border-[#dd2200] rounded">
            <i class="text-lg lni lni-ban"></i> We are not currently accepting applications
        </div>
        <?php
            }
        ?>
    </x-authentication-card>
</x-guest-no-bg-layout>
