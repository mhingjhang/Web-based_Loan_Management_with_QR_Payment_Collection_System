<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Borrower;
use App\Models\Loan;


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

    public function voidRepayment($id)
    {
        // Find the record by its ID
        $record = Payment::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record updated unsuccessfully');
        }

        // Update the "Void" column to "Pending"
        $record->update([
            'Void' => 'Pending'
        ]);

       return redirect()->back()->with('success', 'Record updated successfully');
    }

    public function approveVoid($id){
        // Find the record by its ID
        $record = Payment::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record updated unsuccessfully');
        }

        // Update the "Void" column to "Pending"
        $record->update([
            'Void' => 'Approved'
        ]);

        return redirect()->back()->with('success', 'Record updated successfully');
    }


    public function voidTransactions(){

                $currentDate = now()->toDateString();

        $repayments = Payment::with('loan', 'loan.borrower', 'employee')
            ->where('PaymentDate', $currentDate)
            ->where('Void', 'Pending')
            ->get();

        return view('LoanManagement.voidtransaction', [
            'repayments' => $repayments,

        ]);

    }

    public function showAddRepayment(){
       $loans = Loan::with('borrower')->get();


        return view('LoanManagement.addrepayment', [
            'loans' => $loans,
        ]);
    }

    public function getLoanData($loanID)
    {
        // Fetch loan data based on the provided $loanID
        $loan = Loan::with('borrower')->where('LoanID', $loanID)->first();
        $payment = Payment::where('LoanID', $loanID);
        $paymentSum = Payment::where('LoanID', $loanID)->sum('PaymentAmount');

        // Check if a loan with the given ID exists
        if ($loan) {
            $fullName = $loan->borrower->FirstName . ' ' . $loan->borrower->LastName;
            $outstandingBalance = $loan->TotalAmountDue - $paymentSum;

            // Calculate the number of days from the effective date to the current date
            $effectiveDate = strtotime($loan->EffectiveDate);
            $currentDate = strtotime('today');
            $daysDifference = floor(($currentDate - $effectiveDate) / (60 * 60 * 24));
            $paymentBalance = ($loan->DailyRepayment * $daysDifference) - $paymentSum;

            return response()->json([
                'loanID' => $loan->LoanID,
                'name' => $fullName,
                'outstandingBalance' => $outstandingBalance,
                'paymentBalance' => $paymentBalance,
                // Add more fields as needed
            ]);
        }

        // Return an error response if the loan doesn't exist
        return response()->json(['error' => 'Loan not found'], 404);
    }

    public function addRepayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'loanID' => 'required|exists:loans,LoanID',
            'payment' => 'required|numeric|min:0',
            'paymentDate' => 'required|date',
        ]);

        // Fetch the Loan record based on the loanID
        $loan = Loan::find($request->input('loanID'));

        // Check if the Loan record exists
        if ($loan) {
            // Calculate the durationDays and interest from the Loan record
            $durationDays = $loan->DurationDays;
            $interest = $loan->Interest;

            // Calculate the interestEarned and principalEarned
            $paymentAmount = $request->input('payment');
            $interestEarned = $paymentAmount * (($interest / $durationDays)/100);
            $principalEarned = $paymentAmount - $interestEarned;

            // Create a new Repayment instance and populate its attributes
            $repayment = new Payment();
            $repayment->PaymentAmount = $paymentAmount;
            $repayment->PaymentDate = $request->input('paymentDate');
            $repayment->InterestEarned = $interestEarned;
            $repayment->PrincipalEarned = $principalEarned;
            $repayment->PaymentMethod = 'Walk-in';
            $repayment->Void = 'None';
            $repayment->isPaid = 1;
            $repayment->LoanID = $request->input('loanID');
            $repayment->EmployeeID = 10;
            

            // Save the new Repayment record to the database
            $repayment->save();

            // You can optionally return a response to confirm the successful addition of the repayment
           return redirect()->back()->with('success', 'Record updated successfully');
        }

        // Return an error response if the Loan record doesn't exist
       return redirect()->back()->with('error', 'Record updated unsuccessfully');
    }
}
