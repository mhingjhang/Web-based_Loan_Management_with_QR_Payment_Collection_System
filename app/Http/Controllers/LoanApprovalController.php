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
            ->groupBy('LoanApplicationID');

        $approvals = Approval::with('loanApplication', 'loanApplication.client', 'loanApplication.client.clientBusiness')
            ->joinSub($latestApprovals, 'latest_approvals', function ($join) {
                $join->on('approvals.LoanApplicationID', '=', 'latest_approvals.LoanApplicationID')
                    ->whereColumn('approvals.created_at', '=', 'latest_approvals.latest_date');
            })
            ->orderByDesc('approvals.created_at')
            ->get();

      

        return view('LoanManagement.loanapproval', ['approvals' => $approvals]);

    }


    public function showPromissoryQRCode(){
        $loanApplicationIds = [1]; // Replace with the specific IDs you want to retrieve
        $loanApplications = LoanApplication::with('loan.borrower')
                                        ->whereIn('LoanApplicationID', $loanApplicationIds)
                                        ->get();

        return view('LoanManagement.LoanApprovalModule.promissory-QRCode', ['loanApplications' => $loanApplications]);
    }


}
