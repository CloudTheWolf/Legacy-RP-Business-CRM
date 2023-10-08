@props(['icon' => 'bx bxs-group', 'class' => 'border-warning'])
<x-dashboard-panel class="{{$class}}">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-dashboard-panel>
