<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;

class LoanInformationController extends Controller
{
    public function show()
    {
        $loans = Loan::with('borrower')->get();
 
        return view('LoanManagement.loaninformation', ['loans' => $loans]);
    }
    public function showLoanInformation($id){
        $payments = Payment::with(['loan.borrower.business'])
            ->join('loans', 'payments.LoanID', '=', 'loans.LoanID')
            ->join('borrowers', 'loans.BorrowerID', '=', 'borrowers.BorrowerID')
            ->join('businesses', 'borrowers.BusinessID', '=', 'businesses.BusinessID')
            ->select(
                'payments.*',
                'loans.*',
                'borrowers.*',
                'businesses.*',
                DB::raw('(SELECT COALESCE(SUM(p.PaymentAmount), 0) FROM payments p WHERE p.LoanID = loans.LoanID) AS TotalPaid'),
                DB::raw('(SELECT COALESCE(SUM(p.PrincipalEarned), 0) FROM payments p WHERE p.LoanID = loans.LoanID) AS TotalPrincipalEarned'),
                DB::raw('(SELECT COALESCE(SUM(p.InterestEarned), 0) FROM payments p WHERE p.LoanID = loans.LoanID) AS TotalInterestEarned'),
                DB::raw('loans.TotalAmountDue - COALESCE((SELECT SUM(p.PaymentAmount) FROM payments p WHERE p.LoanID = loans.LoanID), 0) AS Balance')
            )
            ->where('payments.LoanID', $id)
            ->first();



        return view('LoanManagement.loaninforeport', ['payments' => $payments]);
    }
    public function showPaymentHistory($id){
        $payments = Payment::with('loan', 'loan.borrower')
            ->where('LoanID', $id)
            ->get();

        $totalPrincipalEarned = Payment::where('LoanID', $id)->sum('PrincipalEarned');
        $totalInterestEarned = Payment::where('LoanID', $id)->sum('InterestEarned');
        $totalPayment = Payment::where('LoanID', $id)->sum('PaymentAmount');
        $totalAmountDue = Loan::where('LoanID', $id)->value('TotalAmountDue');
        $totalBalance = $totalAmountDue - $totalPayment;
        $countOfPayments = Payment::where('LoanID', $id)
            ->where('isPaid', 1)
            ->count();
        $countOfMissedPayments = Payment::where('LoanID', $id)
            ->where('isPaid', 0)
            ->count();
        $remainingDays = Loan::selectRaw('DATEDIFF(MaturityDate, CURDATE()) AS remaining_days')
            ->where('LoanID', $id)
            ->value('remaining_days');

        return view('LoanManagement.paymenthistory', [
            'payments' => $payments,
            'totalPrincipalEarned' => $totalPrincipalEarned,
            'totalInterestEarned' => $totalInterestEarned,
            'totalPayment' => $totalPayment,
            'totalAmountDue' => $totalAmountDue,
            'totalBalance' => $totalBalance,
            'countOfPayments' => $countOfPayments,
            'countOfMissedPayments' => $countOfMissedPayments,
            'remainingDays' => $remainingDays,
        ]);

    }
    public function showPaymentAmortization($id){
        $loanAmount = 5000;
        $totalAmountDue = 6000;
        $dailyRepayment = 100;
        $interest = 1000;
        $effectiveDate = '2023-06-09';
        $maturityDate = '2023-06-10';
        $durationDays = 60;
        $totalInterest = 0;

        $schedule = [];
        $remainingAmount = $totalAmountDue;

        for ($i = 0; $i < $durationDays; $i++) {
            $paymentDate = Carbon::parse($effectiveDate)->addDays($i)->toDateString();
            $paymentAmount = min($dailyRepayment, $remainingAmount);
            $dailyInterest = $paymentAmount * (($interest / $durationDays)/100);
            $principal = $paymentAmount - $dailyInterest;
            $totalInterest = $totalInterest + $dailyInterest;
            $remainingAmount -= $paymentAmount;

        $schedule[] = [
            'payment_number' => $i + 1,
            'payment_date' => $paymentDate,
            'payment_amount' => number_format($paymentAmount, 2),
            'interest' => number_format($dailyInterest, 2),
            'principal' => number_format($principal, 2),
            'totalInterest' => number_format($totalInterest, 2),
            'remaining_amount' => number_format($remainingAmount, 2),
        ];

        }
        return view('LoanManagement.paymentamortization', ['schedule' => $schedule]);
    }
}
