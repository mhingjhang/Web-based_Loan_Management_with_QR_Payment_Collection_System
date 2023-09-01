@extends('index')
@section('content')

@section('css_styles')
    <style>
        .rounded-field {
            border-radius: 10px;
        }
        .button-menu{
            margin-left: auto; 
            margin-right: 10px;
            padding:8px 15px; 
            font-size: 12px; 
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
    
@endsection


<div  style="background-color: #f0f2f5; padding: 20px;">


</div>

@if ($payments)
    

<div style="background-color: #f0f2f5; padding: 20px;">
    <div style="max-width: 100%; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center;">
                <img src="{{ asset('storage/images/' . $payments->loan->borrower->BorrowerPhoto)}}" alt="Profile Picture" style="width: 80px; height: 80px; border-radius: 50%; margin-right: 20px;">
               
                <div>
                    <h1 style="margin: 0; font-size: 22px;">{{ $payments->loan->borrower->FirstName }} {{ $payments->loan->borrower->MiddleName }} {{ $payments->loan->borrower->LastName}} </h1>
                    <p style="margin: 5px 0; font-size: 14px; color: #505050;">Loan ID: {{ $payments->LoanID}}</p>
                </div>
            </div>

            <div class="d-flex">
                <a href="" class="button button-menu">Print</a>
                <a href="{{ route('showPaymentHistory', ['id' => $payments->loan->LoanID]) }}" class="button button-menu">Payment History</a>
                <a href="{{ route('showPaymentAmortization', ['id' => $payments->loan->LoanID]) }}" class="button button-menu">Payment Amortization</a>
               
            </div>
            
            </div>
            
            

        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">

        <div style="display: flex; justify-content: space-between;">
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->loan->Principal }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Principal</p>
            </div>
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->loan->TotalAmountDue }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Total Amount Due</p>
            </div>
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->TotalPaid }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Total Paid</p>
            </div>
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->Balance }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Outstanding Balance</p>
            </div>
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->TotalPrincipalEarned }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Total Principal Earned</p>
            </div>
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 600; : 24px; color: #1877f2;">{{ $payments->TotalInterestEarned }}</h3>
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Total Interest Earned</p>
            </div>
        </div>
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
        <!-- Borrower, Business, and Loan Information -->
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            
            <!-- Borrower Information Section -->
            <div style="flex-basis: calc(33.33% - 10px); padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
                <h2 style="margin: 0; font-weight: 600; font-size: 20px; color: #1877f2;">Borrower Information</h2>
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="font-size: 14px; color: #505050;"><strong>Gender:</strong>    {{ $payments->loan->borrower->Gender }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Date of Birth:</strong> {{ $payments->loan->borrower->DateOfBirth }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Mobile Number:</strong> {{ $payments->loan->borrower->ContactNumber }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Email:</strong> {{ $payments->loan->borrower->Email }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Address:</strong>   {{ $payments->loan->borrower->Street }}, {{ $payments->loan->borrower->Barangay }}, {{ $payments->loan->borrower->City_Municipality }}, {{ $payments->loan->borrower->Province }}</p>
            </div>
            
            <!-- Business Information Section -->
            <div style="flex-basis: calc(33.33% - 10px); padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
                <h2 style="margin: 0; font-weight: 600; font-size: 20px; color: #1877f2;">Business Information</h2>
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="font-size: 14px; color: #505050;"><strong>Business Name:</strong>  {{ $payments->loan->borrower->business->BusinessName }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Average Daily Income:</strong>  {{ $payments->loan->borrower->business->AverageDailyIncome}}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Type of Business:</strong>{{ $payments->loan->borrower->business->TypeOfBusiness }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Business Address:</strong> {{ $payments->loan->borrower->business->Street }}, {{ $payments->loan->borrower->business->Barangay }}, {{ $payments->loan->borrower->business->City_Municipality }}, {{ $payments->loan->borrower->business->Province }}</p>
            </div>
            
            <!-- Loan Information Section -->
            <div style="flex-basis: calc(33.33% - 10px); padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
                <h2 style="margin: 0; font-weight: 600; font-size: 20px; color: #1877f2;">Loan Information</h2>
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="font-size: 14px; color: #505050;"><strong>Effective Date:</strong>{{ $payments->loan->EffectiveDate }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Loan Duration:</strong> {{ $payments->loan->DurationMonths }} months</p>
                <p style="font-size: 14px; color: #505050;"><strong>Duration in Days:</strong> {{ $payments->loan->DurationDays }} months</p>
                <p style="font-size: 14px; color: #505050;"><strong>Interest Rate:</strong> {{ $payments->loan->InterestRate }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Interest:</strong> {{ $payments->loan->Interest }}</p>
                <p style="font-size: 14px; color: #505050;"><strong>Service Charge:</strong> {{ $payments->loan->ServiceFee }}</p>
            </div>
            
        </div>
        
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">

        <!-- Placeholders for pictures -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="text-align: center;">
                <img src="{{ asset('storage/images/' . $payments->loan->borrower->business->EstablishmentPhoto)}}" alt="Business Establishment" style="width: 200px; height: auto; border-radius: 10px; background-color: #ccc;">
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Business Establishment</p>
            </div>
            <div style="text-align: center;">
                <img src="{{ asset('storage/images/' . $payments->loan->borrower->ValidIDPhoto)}}" alt="Valid ID" style="width: 350px; height: auto; border-radius: 10px; background-color: #ccc;">
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Valid ID</p>
            </div>
            <div style="text-align: center;">
                <img src="{{ asset('storage/images/' . $payments->loan->borrower->business->BusinessPermitPhoto)}}" alt="Business Permit" style="width: 200px; height: auto; border-radius: 10px; background-color: #ccc;">
                <p style="margin: 5px 0; font-size: 14px; color: #505050;">Business Permit (Optional)</p>
            </div>
        </div>

    </div>
</div>
@endif


@endsection
