@extends('index')
@section('content')

<div id="loanApplicationContent">

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <form action="{{route('loanapplication.saveBorrowerandBusinessInformation')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Loan Application</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>  
        </div>
    
        <h2 class="subtitle">Personal Information</h1>
    
        <div class="row">
            <div class="col-md-4">
                <label for="firstName" class="form-label fs-6">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
            </div>
            <div class="col-md-4">
                <label for="middleName" class="form-label fs-6">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Enter your middle name" required>
            </div>
            <div class="col-md-4">
                <label for="lastName" class="form-label fs-6">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-2">
                <label for="gender" class="form-label fs-6">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option selected disabled>Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <label for="dateOfBirth" class="form-label fs-6">Date of Birth</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="Select date of birth" required>
            </div>
    
            <div class="col-md-4">
                <label for="mobileNumber" class="form-label fs-6">Mobile Number</label>
                <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" pattern="[0-9]{1,12}" maxlength="12" required>
            </div>
            
            <div class="col-md-4">
                <label for="email" class="form-label fs-6">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
        </div>
    
        <div class="row">
             <div class="col-md-3">
                <label for="street" class="form-label fs-6">Street/Purok</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Enter your street/purok" required>
            </div>
            <div class="col-md-3">
                <label for="barangay" class="form-label fs-6">Barangay</label>
                <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter your barangat" required>
            </div>
            <div class="col-md-3">
                <label for="city" class="form-label fs-6">City/Municipality</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city/municipality" required>
            </div>
            <div class="col-md-3">
                <label for="province" class="form-label fs-6">Province</label>
                <input type="text" class="form-control" id="province" name="province" placeholder="Enter your province" required>
            </div>
        </div>
    
    
         <h2 class="subtitle">Business Information</h1>
    
        <div class="row">
            <div class="col-md-4">
                <label for="businessName" class="form-label fs-6">Business Name</label>
                <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter your business name" required>
            </div>
            <div class="col-md-4">
                <label for="averageDailyIncome" class="form-label fs-6">Average Daily Income</label>
                <input type="number" class="form-control" id="averageDailyIncome" name="averageDailyIncome" placeholder="Enter your average daily income" required>
            </div>
            <div class="col-md-4">
                <label for="typeOfBusiness" class="form-label fs-6">Type of Business</label>
                <select class="form-select" id="typeOfBusiness" name="typeOfBusiness" required>
                    <option selected disabled>Select type of business</option>
                    <option value="retail">Retail</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="service">Service</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
    
        <div class="row">
           <div class="col-md-3">
                <label for="businessstreet" class="form-label fs-6">Street/Purok</label>
                <input type="text" class="form-control" id="businessstreet" name="businessstreet" placeholder="Enter your street/purok" required>
            </div>
            <div class="col-md-3">
                <label for="businessbarangay" class="form-label fs-6">Barangay</label>
                <input type="text" class="form-control" id="businessbarangay" name="businessbarangay" placeholder="Enter your barangay" required>
            </div>
            <div class="col-md-3">
                <label for="businessCity" class="form-label fs-6">City/Municipality</label>
                <input type="text" class="form-control" id="businessCity" name="businessCity" placeholder="Enter your business city/municipality" required>
            </div>
            <div class="col-md-3">
                <label for="businessProvince" class="form-label fs-6">Province</label>
                <input type="text" class="form-control" id="businessProvince" name="businessProvince" placeholder="Enter your business province" required>
            </div>
        </div>
    
        <h2 class="subtitle">Documents</h1>
    
        <div class="row">
            <div class="col-md-3">
                <label for="borrower_photo" class="form-label fs-6">Borrower Photo</label>
                <input type="file" class="" id="borrower_photo" name="borrower_photo" required>
            </div>
            <div class="col-md-3">
                <label for="id_photo" class="form-label fs-6">ID Photo</label>
                <input type="file" class="" id="id_photo" name="id_photo" required>
            </div>
            <div class="col-md-3">
                <label for="establishment_photo" class="form-label fs-6">Establishment Photo</label>
                <input type="file" class="" id="establishment_photo" name="establishment_photo" required>
            </div>
            <div class="col-md-3">
                <label for="business_permit" class="form-label fs-6">Business Permit</label>
                <input type="file" class="" id="business_permit" name="business_permit" required>
            </div>
        </div>
    </form>
</div>

@endsection
