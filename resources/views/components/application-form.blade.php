<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-20 fixed-background">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
