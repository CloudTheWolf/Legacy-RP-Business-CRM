<?php

namespace App\Http\Livewire\Mechanic\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CityTowLog;

class RecentImpound extends DataTableComponent
{
    public function builder(): Builder
    {
        return CityTowLog::query()
            ->where('characterId',Auth::user()->cid)
            ->orderBy('timestamp','desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }

    public function columns(): array
    {
        return [
            Column::make("Timestamp", "timestamp")
                ->sortable(),
            Column::make("Model Name", "modelName"),
            Column::make("Reward", "reward"),
            Column::make("Vehicle Type", "playerVehicle")
                ->format(fn($value, $row, Column $column) => $value = $value == 1 ? 'Citizen' :'Local'),
            Column::make("Plate Number", "plateNumber"),

        ];
    }
}
