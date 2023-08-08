<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DisbursementPendingView;

class DisbursementPendingViewTable extends DataTableComponent
{
    protected $model = DisbursementPendingView::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
           Column::make("Borrower Name", "BorrowerName")
                ->sortable()
                ->searchable(),
            Column::make("Loan Amount", "Principal")
                ->sortable(),
            Column::make("Status", "Status")
                ->sortable(),
            Column::make('Actions')
                ->label(function($row, Column $column) {
                    return view('livewire.table-actions-disbursement-pending');
                }),
        ];
    }
}
