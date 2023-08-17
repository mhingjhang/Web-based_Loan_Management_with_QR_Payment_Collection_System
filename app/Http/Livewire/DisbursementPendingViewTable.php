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
        $this->setPrimaryKey('LoanApplicationID')
            ->setTableRowUrl(function($row) {
                return view('livewire.table-actions-disbursement-pending', $row);
            });
    }

    public function columns(): array
    {
        return [
           Column::make("Borrower Name", "ClientName")
                ->sortable()
                ->searchable(),
            Column::make("Loan Amount", "Principal")
                ->sortable(),
            Column::make("Status", "Status")
                ->sortable(),
            Column::make('Action')
                ->label(function ($row, Column $column) {
                    // dd($row);
                    return view('livewire.table-actions-disbursement-pending', ['user' => $row->Principal]);
                }),


        ];
    }
}
