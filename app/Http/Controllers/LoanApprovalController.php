<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanApplication;

class LoanApprovalController extends Controller
{
    public function show()
    {
        $loanApplications = LoanApplication::with('loan.borrower');

        return view('LoanManagement.loanapproval', ['loanApplications' => $loanApplications]);
    }

    public function showPromissoryQRCode(){
        $loanApplicationIds = [1]; // Replace with the specific IDs you want to retrieve
        $loanApplications = LoanApplication::with('loan.borrower')
                                        ->whereIn('LoanApplicationID', $loanApplicationIds)
                                        ->get();

        return view('LoanManagement.LoanApprovalModule.promissory-QRCode', ['loanApplications' => $loanApplications]);
    }


}
