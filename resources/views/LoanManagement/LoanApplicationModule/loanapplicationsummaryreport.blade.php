@extends('index')
@section('content')

<div id="loanApplicationContent">

    <form action="{{route('loanapplication.store')}}" method="post" enctype="multipart/form-data">
        @csrf
         <div class="row">
            <div class="col-md-6">
                <h1 class="title">Loan Application Summary</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" onclick="history.back();" class="btn btn-primary mr-4">Back</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <div class="info-data">
             <div class="card">
                <div class="head">
                    <div>
                        <h4 style="font-weight: 800; color: #004EDA;">Borrower Information</h4>
                        <br>
                        <p>Name: {{ session('loan_application.firstName') }} {{ session('loan_application.middleName') }} {{ session('loan_application.lastName') }}</p>
                        <p>Gender: {{ session('loan_application.gender') }}</p>
                        <p>Date of Birth: {{ session('loan_application.dateOfBirth') }}</p>
                        <p>Mobile Number: {{ session('loan_application.mobileNumber') }}</p>
                        <p>Email: {{ session('loan_application.email') }}</p>
                        <p>Street: {{ session('loan_application.street') }}</p>
                        <p>Barangay: {{ session('loan_application.barangay') }}</p>
                        <p>City/Municipality: {{ session('loan_application.city') }}</p>
                        <p>Province: {{ session('loan_application.province') }}</p>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="head">
                    <div>
                        <h4 style="font-weight: 800; color: #004EDA;">Business Information</h4>
                        <br>
                        <p>Business Name: {{ session('loan_application.businessName') }}</p>
                        <p>Average Daily Income: {{ session('loan_application.averageDailyIncome') }}</p>
                        <p>Type of Business: {{ session('loan_application.typeOfBusiness') }}</p>
                        <p>Street: {{ session('loan_application.businessstreet') }}</p>
                        <p>Barangay: {{ session('loan_application.businessbarangay') }}</p>
                        <p>City/Municipality: {{ session('loan_application.businessCity') }}</p>
                        <p>Province: {{ session('loan_application.businessProvince') }}</p>
                    </div>
                </div>
            </div>

            {{-- Loan Information Card --}}
            <div class="card">
                <div class="head">
                    <div>
                        <h4 style="font-weight: 800; color: #004EDA;">Loan Information</h4>
                        <br>
                        <p>Loan Amount: {{ session('loan_application.loanAmount') }}</p>
                        <p>Loan Duration: {{ session('loan_application.loanDuration') }} days</p>
                        <p>Daily Repayment: {{ session('loan_application.dailyRepayment') }}</p>
                        <p>Service Fee: {{ session('loan_application.serviceFee') }}</p>
                        <p>Total Disbursement: {{ session('loan_application.totalDisbursement') }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="info-data">
            <div class="card">
                <div class="head">
                    <h4 style="font-weight: 800; color: #004EDA;">Borrower Photo</h4>
                    <img src="{{ asset('images/' . $loan_application['borrower_photo']) }}" alt="Profile Picture">
                </div>
            </div>

            <div class="card">
                <div class="head">
                    <h4 style="font-weight: 800; color: #004EDA;">Borrower ID</h4>
                    <img src="{{ asset('images/' . $loan_application['id_photo']) }}" alt="Profile Picture">
                </div>
            </div>

        </div>

        <div class="info-data">

            <div class="card">
                <div class="head">
                    <h4 style="font-weight: 800; color: #004EDA;">Establishment Photo</h4>
                    <img src="{{ asset('images/' . $loan_application['establishment_photo']) }}" alt="Profile Picture">
                </div>
            </div>

            <div class="card">
                <div class="head">
                    <h4 style="font-weight: 800; color: #004EDA;">Business Permit</h4>
                    <img src="{{ asset('images/' . $loan_application['business_permit']) }}" alt="Profile Picture">
                </div>
            </div>


            

        </div>

    
       

    </form>
</div>

@endsection
