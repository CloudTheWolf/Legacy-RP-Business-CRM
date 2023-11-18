<?php

namespace App\Http\Livewire\Mechanic\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RepairLog;

class AllRepairsTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return RepairLog::query()
            ->whereDeleted(0)
            ->with('users')
            ->orderBy('timestamp','desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('mechanic-repair-log-edit',['id' => $row]);
            })
            ->setTableRowUrlTarget(function($row) {
                return 'navigate';
            });;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("Mechanic", "users.name"),
            Column::make("Customer name", "customer_name"),
            Column::make("Vehicle", "vehicle"),
            Column::make("Scrap used", "scrap_used")
                ->collapseAlways(),
            Column::make("Alum used", "alum_used")
                ->collapseAlways(),
            Column::make("Steel used", "steel_used")
                ->collapseAlways(),
            Column::make("Glass used", "glass_used")
                ->collapseAlways(),
            Column::make("Rubber used", "rubber_used")
                ->collapseAlways(),
            Column::make("AdvKit", "advKit")
                ->collapseAlways(),
            Column::make("Oil", "oil")
                ->collapseAlways(),
            Column::make("Cost", "cost")
                ->collapseAlways()

        ];
    }
}
