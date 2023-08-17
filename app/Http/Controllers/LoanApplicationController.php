<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientBusiness;
use App\Models\Client;
use App\Models\LoanApplication;
use App\Models\Approval;


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

        $clientbusiness = new ClientBusiness;
        $clientbusiness->BusinessName = $validatedData['businessName'];
        $clientbusiness->AverageDailyIncome = $validatedData['averageDailyIncome'];
        $clientbusiness->TypeOfBusiness = $validatedData['typeOfBusiness'];
        $clientbusiness->Street = $validatedData['businessstreet'];
        $clientbusiness->Barangay = $validatedData['businessbarangay'];
        $clientbusiness->City_Municipality = $validatedData['businessCity'];
        $clientbusiness->Province = $validatedData['businessProvince'];
        $clientbusiness->EstablishmentPhoto = $validatedData['establishment_photo']; // Ensure this is the file path
        $clientbusiness->BusinessPermitPhoto = $validatedData['business_permit']; // Ensure this is the file path
        $clientbusiness->Status = 'Active'; // Update as needed
        $clientbusiness->save();

        $client = new Client;
        $client->ClientBusinessID = $clientbusiness->ClientBusinessID;
        $client->UserAccountID = 1; // Update this as needed
        $client->FirstName = $validatedData['firstName'];
        $client->MiddleName = $validatedData['middleName'];
        $client->LastName = $validatedData['lastName'];
        $client->Gender = $validatedData['gender'];
        $client->DateOfBirth = $validatedData['dateOfBirth'];
        $client->ContactNumber = $validatedData['mobileNumber'];
        $client->Email = $validatedData['email'];
        $client->Street = $validatedData['street'];
        $client->Barangay = $validatedData['barangay'];
        $client->City_Municipality = $validatedData['city'];
        $client->Province = $validatedData['province'];
        $client->BorrowerPhoto = $validatedData['borrower_photo']; // Ensure this is the file path
        $client->ValidIDPhoto = $validatedData['id_photo']; // Ensure this is the file path
        $client->Status = 'Active'; // Update as needed
        $client->save();


        $loanApplication = new LoanApplication;
        $loanApplication->ClientID = $client->ClientID;
        $loanApplication->EmployeeID = 8; 
        $loanApplication->ApplicationDate = now(); 
        $Interest = ($validatedData['loanAmount'] * 0.10) * 2;
        $loanApplication->Principal = $validatedData['loanAmount'];
        $loanApplication->DurationDays = $validatedData['loanDuration'];
        $loanApplication->DurationMonths = $validatedData['loanDuration'] / 30; // Update this as needed
        $loanApplication->Interest = $Interest; 
        $loanApplication->InterestRate = 0.10; 
        $loanApplication->TotalAmountDue = $validatedData['loanAmount'] + $Interest; // Update as needed
        $loanApplication->DailyRepayment = $validatedData['dailyRepayment'];
        $loanApplication->ServiceFee = $validatedData['serviceFee'];
        $loanApplication->Status = 'Pending'; 
        $loanApplication->save();

        $approval = new Approval;
        $approval->ApprovalLevelID = 1;
        $approval->LoanApplicationID = $loanApplication->LoanApplicationID;
        $approval->save();

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
