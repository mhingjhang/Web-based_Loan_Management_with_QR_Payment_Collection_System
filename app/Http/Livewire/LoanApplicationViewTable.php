<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LoanApplicationView;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class LoanApplicationViewTable extends DataTableComponent
{
    protected $model = LoanApplicationView::class;

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
                    return view('livewire.table-actions');
                }),
        ];
    }

    public function filters(): array
    {
        return [
           SelectFilter::make('Status')
            ->options([
                '' => 'All',
                'Pending' => 'Pending',
                'Approved' => 'Approved',
                'Rejected' => 'Rejected',
            ])
            ->filter(function(\Illuminate\Database\Eloquent\Builder $builder, string $value) {
                if ($value === 'Pending') {
                    $builder->where('Status', 'Pending');
                } elseif ($value === 'Approved') {
                    $builder->where('Status', 'Approved');
                } elseif ($value === 'Rejected') {
                    $builder->where('Status', 'Rejected');
                }
            }),

            SelectFilter::make('Approval')
            ->options([
                '' => 'All',
                'BorrowerandIncomeEvaluation' => 'Borrower and Income Evaluation',
                'PaymentHistory' => 'Payment History Evaluation',
                'CIApproval' => 'CI Approval',
                'DisbursementApproval' => 'Disbursement Approval',
            ])
            ->filter(function(\Illuminate\Database\Eloquent\Builder $builder, string $value) {
                if ($value === 'BorrowerandIncomeEvaluation') {
                    $builder->where('Approval', 'Borrower and Income Evaluation');
                } elseif ($value === 'PaymentHistory') {
                    $builder->where('Approval', 'Payment History');
                } elseif ($value === 'CIApproval') {
                    $builder->where('Approval', 'CI Approval');
                } elseif ($value === 'DisbursementApproval') {
                    $builder->where('Approval', 'Disbursement Approval');
                }
            }),


        ];
    }

}
