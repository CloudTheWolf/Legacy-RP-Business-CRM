@props(['application'])


<div class="col-span-1 ml-0.5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-3 pt-3 dark">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://ui-avatars.com/api/?name={{$application->name}}&color=7F9CF5&background=EBF4FF" alt="{{$application->name}}"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$application->name}}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{$application->cid}}</span>
            <div class="flex mt-4 space-x-3 md:mt-6">
                <p class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined">phone_in_talk</span> {{$application->cell}}</p>
                    <p class="inline-flex items-center px-4 py-2 text-sm font-medium text-center border rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-purple-800 dark:text-white dark:border-purple-600 dark:hover:bg-purple-700 dark:hover:border-purple-700 dark:focus:ring-green-700">{{$application->discord }}</p>
            </div>
            <div class="flex mt-4 space-x-3 md:mt-6">
                <a href="{{route('admin-view-application',['id' => $application->id])}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 cursor-pointer" wire:navigate>View Application</a>
            </div>
    </div>
</div>


