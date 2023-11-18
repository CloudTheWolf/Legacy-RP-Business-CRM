<?php

namespace App\Http\Livewire\Mechanic\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RepairLog;

class MyRecentRepairsTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return RepairLog::query()
            ->whereCid(Auth::user()->cid)
            ->orderBy('timestamp','desc')
            ->limit(10);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setColumnSelectDisabled();
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPage(10);
        $this->setRefreshTime(10000);
        $this->setPaginationDisabled();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("Vehicle", "vehicle"),
            Column::make("Scrap used", "scrap_used")
                ->collapseOnTablet(),
            Column::make("Alum used", "alum_used")
                ->collapseOnTablet(),
            Column::make("Steel used", "steel_used")
                ->collapseOnTablet(),
            Column::make("Glass used", "glass_used")
                ->collapseOnTablet(),
            Column::make("Rubber used", "rubber_used")
                ->collapseOnTablet(),
            Column::make("AdvKit", "advKit")
                ->collapseOnTablet(),
            Column::make("Oil", "oil")
                ->collapseOnTablet(),
            Column::make("Cost", "cost"),
        ];
    }
}
