<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LoanApplicationApprovedView;

class LoanApplicationApprovedViewTable extends DataTableComponent
{
    protected $model = LoanApplicationApprovedView::class;

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
            Column::make("Application Date", "ApplicationDate")
                ->sortable(),
            Column::make("Approval", "Approval")
                ->sortable(),
            Column::make("Status", "Status")
                ->sortable(),
            Column::make('Actions')
                ->label(function($row, Column $column) {
                    return view('livewire.table-actions-approved');
                }),
        ];
    }

    
}
