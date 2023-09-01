<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class RepaymentController extends Controller
{
    public function show()
    {
        $currentDate = now()->toDateString();

        $repayments = Payment::with('loan', 'loan.borrower', 'employee')
            ->where('PaymentDate', $currentDate)
            ->get();

        $totalPrincipalEarned = Payment::sum('PrincipalEarned');
        $totalInterestEarned = Payment::sum('InterestEarned');
        $totalPayment = Payment::sum('PaymentAmount');
        $countOfPayments = Payment::where('isPaid', 1)
            ->count();
        $countOfMissedPayments = Payment::where('isPaid', 0)
            ->count();

        return view('LoanManagement.repayment', [
            'repayments' => $repayments,
            'totalPrincipalEarned' => $totalPrincipalEarned,
            'totalInterestEarned' => $totalInterestEarned,
            'totalPayment' => $totalPayment,
            'countOfPayments' => $countOfPayments,
            'countOfMissedPayments' => $countOfMissedPayments
        ]);

    
       
    }
}
