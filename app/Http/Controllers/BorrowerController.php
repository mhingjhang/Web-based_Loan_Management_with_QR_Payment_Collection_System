<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;

use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function show()
    {
        $payments = Payment::join('loans', 'payments.LoanID', '=', 'loans.LoanID')
            ->join('borrowers', 'loans.BorrowerID', '=', 'borrowers.BorrowerID')
            ->join('businesses', 'borrowers.BusinessID', '=', 'businesses.BusinessID')
            ->select(
                'borrowers.BorrowerID',
                'loans.LoanID',
                'borrowers.BorrowerPhoto',
                DB::raw("CONCAT(borrowers.FirstName, ' ', borrowers.LastName) AS Borrowers"),
                'businesses.BusinessName',
                'businesses.TypeOfBusiness',
                'borrowers.ContactNumber',
                'loans.TotalAmountDue',
                DB::raw('COALESCE(SUM(payments.PaymentAmount), 0) AS TotalPaid'),
                DB::raw('loans.TotalAmountDue - COALESCE(SUM(payments.PaymentAmount), 0) AS Balance')
            )
            ->groupBy(
                'borrowers.BorrowerID',
                'LoanID',
                'BorrowerPhoto',
                'Borrowers',
                'businesses.BusinessName',
                'businesses.TypeOfBusiness',
                'borrowers.ContactNumber',
                'loans.TotalAmountDue'
            )
            ->get();


        return view('LoanManagement.borrower', ['payments' => $payments]);
        
    }
    public function showBorrowerInformation($id){
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



        return view('LoanManagement.borrowerInformation', ['payments' => $payments]);

    }

}
