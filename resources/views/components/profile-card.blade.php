@props(['user'])


<div class="col-span-1  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-3 pt-3 dark">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ strlen($user->avatar_url) > 0 ? $user->avatar_url : $user->profile_photo_url }}" alt="{{$user->name}}"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->name}}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{$user->role}}</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{strlen($user->towID) > 0 ? str_replace(';',' ',str_replace(',',' ',$user->towID)) : '-'}}</span>
            <div class="flex mt-4 space-x-3 md:mt-6">
                <p class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined">phone_in_talk</span> {{$user->cell}}</p>
                    <p class="inline-flex items-center px-4 py-2 text-sm font-medium text-center border rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 {{$user->onDuty ? 'dark:bg-green-800 dark:text-white dark:border-green-600 dark:hover:bg-green-700 dark:hover:border-green-700 dark:focus:ring-green-700': 'dark:bg-red-400 dark:text-white dark:border-red-600 dark:hover:bg-red-700 dark:hover:border-red-700 dark:focus:ring-red-700'}}">{{$user->onDuty ? 'On Duty': 'Off Duty'}}</p>
            </div>
    </div>
</div>


