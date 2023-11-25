<div class="px-2 py-2 min-h-[250px] max-h-[250px] overflow-y-auto">
    <div class="flex-auto p-6 content-center">
        <div class="flex content-center">
                <h6 class="mb-0 text-white">{{__('On Duty')}}</h6>
        </div>
        <ul>
            @foreach($onDutyList as $od)
            <li class="text-white text-sm px-1 pt-1">
                {{$od->name}}
                <span class="text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 rounded-full px-2">
                    {{$od->workingAs}}
                </span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
