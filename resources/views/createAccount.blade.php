@extends('index')
@section('content')


    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center">
    <h1 class="title">Create Account</h1>
    <div class="d-flex">

        <a href="#" class="btn btn-primary mr-3" style="border-radius: 10px;">Edit Account</a>
        <a href="{{route('showCreateAccount')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Create Account</a>
       
        <button class="btn btn-primary" style="border-radius: 10px;">Print</button>
    </div>
    
</div>


<br>
<div id="createAccountContent">
    <form action="{{ route('createAccount') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row" style="width: 100%; display:flex; justify-content: center;">
            <!-- Circular image placeholder -->
            <label for="borrower_photo" class="circular-image-placeholder" id="previewImage">
                Upload Photo
            </label>
            <!-- File input (hidden) -->
            <input type="file" class="" id="borrower_photo" name="borrower_photo" required onchange="displaySelectedImage(this)">
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="firstName" class="form-label fs-6">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="middleName" class="form-label fs-6">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middle_name" placeholder="Enter your middle name" required>
            </div>
            <div class="col-md-4">
                <label for="lastName" class="form-label fs-6">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="email" class="form-label fs-6">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="col-md-4">
                <label for="contactNumber" class="form-label fs-6">Contact Number</label>
                <input type="text" class="form-control" id="contactNumber" name="contact_number" placeholder="Enter your contact number" required>
            </div>
            <div class="col-md-2">
                <label for="position" class="form-label fs-6">Position</label>
                <select class="form-select" id="position" name="position" required>
                    <option selected disabled>Select Position</option>
                    <option value="lender">Lender</option>
                    <option value="collector">Collector</option>
                    <option value="auditor">Auditor</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="username" class="form-label fs-6">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label fs-6">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="col-md-4">
                <label for="confirmPassword" class="form-label fs-6">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm your password" required>
            </div>
        </div>
        <br>
        <div class="row" style="width: 100%; display:flex; justify-content: center;">
            <button type="submit" class="btn btn-primary">Create Account</button>
        </div>
    </form>
</div>



@section('javascript')
        <script>
            let table = new DataTable('#profileTable');

            function goBack() {
                window.history.back();
            }

            function displaySelectedImage(input) {
                if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Update the src attribute of the img element with the selected image
                    document.getElementById('previewImage').style.backgroundImage = `url(${e.target.result})`;
                    document.getElementById('previewImage').innerHTML = ''; // Clear any text content
                };

                reader.readAsDataURL(input.files[0]);
                }
            }

        </script>
@endsection

@endsection