<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanApplication;
use App\Models\Approval;

class LoanApprovalController extends Controller
{
    public function show()
    {
        $latestApprovals = Approval::selectRaw('MAX(created_at) as latest_date, LoanApplicationID')
            ->groupBy('LoanApplicationID')
            ->get()
            ->pluck('latest_date', 'LoanApplicationID');

        $approvals = Approval::with('loanApplication', 'loanApplication.client', 'loanApplication.client.clientBusiness')
            ->whereIn('LoanApplicationID', $latestApprovals->keys())
            ->where(function ($query) use ($latestApprovals) {
                foreach ($latestApprovals as $loanId => $date) {
                    $query->orWhere(function ($query) use ($loanId, $date) {
                        $query->where('LoanApplicationID', $loanId)
                              ->where('created_at', $date);
                    });
                }
            })
            ->orderByDesc('created_at')
            ->get();

        $loans = Loan::with('borrower', 'borrower.business')->get();

        return view('LoanManagement.loanapproval', ['approvals' => $approvals, 'loans' => $loans]);
    }


    public function showPromissoryQRCode($id){
    
        $loans = Loan::with('borrower', 'borrower.business')
                ->where('LoanID', $id)
                ->get();

        return view('LoanManagement.LoanApprovalModule.promissory-QRCode', ['loans' => $loans]);
    }


}
