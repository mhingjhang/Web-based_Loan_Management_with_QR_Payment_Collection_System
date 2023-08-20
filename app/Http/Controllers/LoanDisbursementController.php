<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanApplication;
use App\Models\Approval;
use App\Models\Business;
use App\Models\Borrower;
use App\Models\Fund;


class LoanDisbursementController extends Controller
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

             $totalAmount = Fund::sum('Amount');
             $totalDisbursement = Loan::sum('Principal');


        return view('LoanManagement.loandisbursement', ['approvals' => $approvals, 'loans' => $loans, 'totalAmount' => $totalAmount, 'totalDisbursement' => $totalDisbursement]);
        
    }

    public function store(Request $request, $id)
    {
       
        // Validation
        $data = $request->validate([
            'disbursementAmount' => 'required|numeric',
        ]);

       $loanApp = LoanApplication::with(['client', 'client.clientBusiness'])->find($id);

       $business = new Business;
       $business->BusinessName = $loanApp->client->clientBusiness->BusinessName;
       $business->AverageDailyIncome = $loanApp->client->clientBusiness->AverageDailyIncome;
       $business->TypeOfBusiness = $loanApp->client->clientBusiness->TypeOfBusiness;
       $business->Street = $loanApp->client->clientBusiness->Street;
       $business->Barangay = $loanApp->client->clientBusiness->Barangay;
       $business->City_Municipality = $loanApp->client->clientBusiness->City_Municipality;
       $business->Province = $loanApp->client->clientBusiness->Province;
       $business->EstablishmentPhoto = $loanApp->client->clientBusiness->EstablishmentPhoto;
       $business->BusinessPermitPhoto = $loanApp->client->clientBusiness->BusinessPermitPhoto;
       $business->Status = $loanApp->client->clientBusiness->Status;
       $business->save();

       $borrower = new Borrower;
       $borrower->FirstName = $loanApp->client->FirstName;
       $borrower->MiddleName = $loanApp->client->MiddleName;
       $borrower->LastName = $loanApp->client->LastName;
       $borrower->Gender = $loanApp->client->Gender;
       $borrower->DateOfBirth = $loanApp->client->DateOfBirth;
       $borrower->ContactNumber = $loanApp->client->ContactNumber;
       $borrower->Email = $loanApp->client->Email;
       $borrower->Street = $loanApp->client->Street;
       $borrower->Barangay = $loanApp->client->Barangay;
       $borrower->City_Municipality = $loanApp->client->City_Municipality;
       $borrower->Province = $loanApp->client->Province;
       $borrower->BorrowerPhoto = $loanApp->client->BorrowerPhoto;
       $borrower->ValidIDPhoto = $loanApp->client->ValidIDPhoto;
       $borrower->Status = $loanApp->client->Status;
       $borrower->BusinessID = $business->BusinessID;
       $borrower->EmployeeID = 1;
       $borrower->UserAccountID = 1;
       $borrower->save();
       

        $loan = new Loan;
        $loan->Principal = $data['disbursementAmount'];
        $loan->DurationDays = $loanApp->DurationDays;
        $loan->DurationMonths = $loanApp->DurationMonths;
        $loan->InterestRate = $loanApp->InterestRate;
        $loan->Interest = $loan->Principal * ($loan->InterestRate);
        $loan->TotalAmountDue = $loan->Principal + $loan->Interest;
        $loan->DailyRepayment = $loan->TotalAmountDue / $loan->DurationDays;
        $loan->ServiceFee = $loan->Principal * 0.011;
        $loan->Disbursement = $loan->Principal - $loan->ServiceFee;
        $loan->DisbursementDate = now(); 
        $loan->EffectiveDate = now()->addDay();
        $loan->MaturityDate = $loan->EffectiveDate->addDays($loan->DurationDays);
        $loan->Status = 'Approved';
        $loan->BorrowerID = $borrower->BorrowerID; 
        $loan->save();

        $approval = new Approval;
        $approval->ApprovalLevelID = 5;
        $approval->LoanApplicationID = $id;
        $approval->save();
       
        return back()->with('success', 'Loan saved successfully!');

    }

    public function addfund(Request $request)
    {
        
        $funddata = $request->validate([
            'addFund' => 'required|numeric',
        ]);



        $fund = new Fund;
        $fund->TransactionDate = now()->addDay();
        $fund->Amount = $funddata['addFund'];
        $fund->TransactionType = 'Add Capital';
        $fund->EmployeeID = 1;
        $fund->LoanID = null;
        $fund->RemittanceID = null;
        $fund->save();

         return back()->with('success', 'Fund Added successfully!');
    }
}
