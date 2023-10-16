@props(['icon' => 'bx bxs-group', 'class' => 'border-yellow-500'])
<x-dashboard-panel class="{{$class}}">
    <div class="flex-auto p-6">
        <div class="flex items-center">
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-dashboard-panel>
