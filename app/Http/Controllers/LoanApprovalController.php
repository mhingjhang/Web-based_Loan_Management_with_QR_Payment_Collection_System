<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanApplication;

class LoanApprovalController extends Controller
{
    public function show()
    {
        $loanApplications = LoanApplication::with('loan.borrower')->paginate(10); // Here, '10' is the number of records per page.

        return view('LoanManagement.loanapproval', ['loanApplications' => $loanApplications]);
    }

}
