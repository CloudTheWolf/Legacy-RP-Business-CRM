<x-guest-no-bg-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />

        </x-slot>
        <p class="text-center text-white">
            Would you like to link your Steam account?
        </p>
        <hr class="py-1" />
        <div class="text-center bg-black hover:bg-black text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 border border-black hover:border-white rounded">
        <a href="{{route("apply.auth.steam")}}" class=""><i class="text-lg lni lni-steam"></i> Link with Steam</a>
        </div>
        <div>
            <form method="post">
                @csrf
                <input type="hidden" name="steamId" value="0">
                <button type="submit" class="mt-1 text-center bg-green-700 hover:bg-green-700 text-white font-semibold hover:text-[#FAF9F6] py-2 px-4 rounded w-full">Skip Step</button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-no-bg-layout>
