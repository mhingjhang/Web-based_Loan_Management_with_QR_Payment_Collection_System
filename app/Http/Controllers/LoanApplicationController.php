<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Business;
use App\Models\Borrower;
use App\Models\Loan;
use App\Models\LoanApplication;


class LoanApplicationController extends Controller
{
    public function show()
    {
        return view('LoanManagement.LoanApplicationModule.loanapplication');
    }
    
    public function saveBorrowerandBusinessInformation(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'mobileNumber' => 'required|string|max:12',
            'email' => 'nullable|email|max:255',
            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'businessName' => 'required|string|max:255',
            'averageDailyIncome' => 'required|numeric',
            'typeOfBusiness' => 'required|string|max:255',
            'businessstreet' => 'required|string|max:255',
            'businessbarangay' => 'required|string|max:255',
            'businessCity' => 'required|string|max:255',
            'businessProvince' => 'required|string|max:255',
            'borrower_photo' => 'required|image',
            'id_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'establishment_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_permit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload for the profile picture
        if ($request->hasFile('borrower_photo')) {
            $file = $request->file('borrower_photo');
            // Generate a unique name for the file to prevent conflicts
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the file to the storage directory (you may configure this as needed)
            Storage::disk('public')->putFileAs('images', $file, $fileName);
            // Save the file name in the form data
            $validated['borrower_photo'] = $fileName;
        }

        if ($request->hasFile('id_photo')) {
            $file = $request->file('id_photo');
            // Generate a unique name for the file to prevent conflicts
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the file to the storage directory (you may configure this as needed)
            Storage::disk('public')->putFileAs('images', $file, $fileName);
            // Save the file name in the form data
            $validated['id_photo'] = $fileName;
        }

        if ($request->hasFile('establishment_photo')) {
            $file = $request->file('establishment_photo');
            // Generate a unique name for the file to prevent conflicts
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the file to the storage directory (you may configure this as needed)
            Storage::disk('public')->putFileAs('images', $file, $fileName);
            // Save the file name in the form data
            $validated['establishment_photo'] = $fileName;
        }

        if ($request->hasFile('business_permit')) {
            $file = $request->file('business_permit');
            // Generate a unique name for the file to prevent conflicts
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the file to the storage directory (you may configure this as needed)
            Storage::disk('public')->putFileAs('images', $file, $fileName);
            // Save the file name in the form data
            $validated['business_permit'] = $fileName;
        }

        $request->session()->put('loan_application', $validated);

        return redirect()->route('showLoan');
    }

    public function saveLoanInformation(Request $request)
    {
        $validated = $request->validate([
            'loanAmount' => 'required|numeric',
            'loanDuration' => 'required|integer',
            'dailyRepayment' => 'required|numeric',
            'serviceFee' => 'required|numeric',
            'totalDisbursement' => 'required|numeric',
        ]);

        $loan_application = $request->session()->get('loan_application', []);
        $loan_application = array_merge($loan_application, $validated);
        $request->session()->put('loan_application', $loan_application);

        return redirect()->route('summary');
    }
    
    public function summary(Request $request)
    {
        $loan_application = $request->session()->get('loan_application', []);
        return view('LoanManagement.LoanApplicationModule.loanapplicationsummaryreport', ['loan_application' => $loan_application]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->session()->get('loan_application');

        $business = new Business;
        $business->BusinessName = $validatedData['businessName'];
        $business->AverageDailyIncome = $validatedData['averageDailyIncome'];
        $business->TypeOfBusiness = $validatedData['typeOfBusiness'];
        $business->Street = $validatedData['businessstreet'];
        $business->Barangay = $validatedData['businessbarangay'];
        $business->City_Municipality = $validatedData['businessCity'];
        $business->Province = $validatedData['businessProvince'];
        $business->EstablishmentPhoto = $validatedData['establishment_photo']; // Ensure this is the file path
        $business->BusinessPermitPhoto = $validatedData['business_permit']; // Ensure this is the file path
        $business->Status = 'active'; // Update as needed
        $business->save();

        $borrower = new Borrower;
        $borrower->BusinessID = $business->BusinessID;
        $borrower->UserAccountID = 0; // Update this as needed
        $borrower->FirstName = $validatedData['firstName'];
        $borrower->MiddleName = $validatedData['middleName'];
        $borrower->LastName = $validatedData['lastName'];
        $borrower->Gender = $validatedData['gender'];
        $borrower->DateOfBirth = $validatedData['dateOfBirth'];
        $borrower->ContactNumber = $validatedData['mobileNumber'];
        $borrower->Email = $validatedData['email'];
        $borrower->Street = $validatedData['street'];
        $borrower->Barangay = $validatedData['barangay'];
        $borrower->City_Municipality = $validatedData['city'];
        $borrower->Province = $validatedData['province'];
        $borrower->BorrowerPhoto = $validatedData['borrower_photo']; // Ensure this is the file path
        $borrower->ValidIDPhoto = $validatedData['id_photo']; // Ensure this is the file path
        $borrower->Status = 'active'; // Update as needed
        $borrower->save();

        $loan = new Loan;
        $Interest = ($validatedData['loanAmount'] * 0.10) * 2;
        $loan->BorrowerID = $borrower->BorrowerID;
        $loan->Principal = $validatedData['loanAmount'];
        $loan->DurationDays = $validatedData['loanDuration'];
        $loan->DurationMonths = $validatedData['loanDuration'] / 30; // Update this as needed
        $loan->Interest = $Interest; // Update this as needed
        $loan->InterestRate = 0.10; // Update this as needed
        $loan->TotalAmountDue = $validatedData['loanAmount'] + $Interest; // Update as needed
        $loan->DailyRepayment = $validatedData['dailyRepayment'];
        $loan->ServiceFee = $validatedData['serviceFee'];
        $loan->Disbursement = null;
        $loan->DisbursementDate = null; // Update this as needed
        $loan->EffectiveDate = null; // Update this as needed
        $loan->MaturityDate = null; // Update this as needed
        $loan->Status = 'pending'; // Update as needed
        $loan->save();

        $loanApplication = new LoanApplication;
        $loanApplication->ApplicationDate = now(); // Update this as needed
        $loanApplication->Approval = 'Borrower and Income Evaluation'; // Update as needed
        $loanApplication->Status = 'Pending'; // Update as needed
        $loanApplication->LoanID = $loan->LoanID;
        $loanApplication->CreditInvestigatorID = null; // Update this as needed
        $loanApplication->CollectorID = null; // Update this as needed
        $loanApplication->save();

        // Flash a success message to the session
        $request->session()->flash('success', 'Loan Application successfully created!');

        $request->session()->forget('loan_application');

        return redirect()->route('loanapplication'); // Redirect as needed
    }


    public function showLoan()
    {
        return view('LoanManagement.LoanApplicationModule.loan');
    }
    
    public function showSummary()
    {
        return view('LoanManagement.LoanApplicationModule.loanapplicationsummaryreport');
    }
}
