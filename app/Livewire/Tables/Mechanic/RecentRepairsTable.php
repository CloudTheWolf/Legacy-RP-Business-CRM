<?php

namespace App\Livewire\Tables\Mechanic;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\RepairLog;
class RecentRepairsTable extends DataTableComponent
{

    public function builder(): Builder
    {
        return RepairLog::query()
            ->whereMechanic(Auth::user()->id)
            ->whereDeleted(0)
            ->orderByDesc("timestamp")
            ->take(25)
            ->select(['id','customer_name','vehicle','scrap_used','alum_used','steel_used','glass_used','rubber_used','advKit','oil','cost']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id','id')
                ->sortable(),
            Column::make('Customer', 'customer_name')
                ->sortable()
                ->searchable(),
            Column::make('Vehicle', 'vehicle')
                ->sortable()
                ->searchable(),
            Column::make('Scrap', 'scrap_used')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Aluminium', 'alum_used')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Steel', 'steel_used')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Glass', 'glass_used')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Rubber', 'rubber_used')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Adv. Repair Kit', 'advKit')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Oil', 'oil')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Final Cost', 'cost')
                ->sortable()
                ->searchable(),
        ];
    }
}
