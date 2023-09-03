@extends('index')
@section('content')


    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center">
    <h1 class="title">Edit Account</h1>
    <div class="d-flex">
        <a href="{{route('profile')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Back</a>
        <a href="{{route('showEditAccount')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Edit Account</a>
        <a href="{{route('showCreateAccount')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Create Account</a>
       
        <button class="btn btn-primary" style="border-radius: 10px;">Print</button>
    </div>
    
</div>


<br>
<div id="createAccountContent">
    <form action="{{ route('updateAccount', ['id' => $employee->EmployeeID]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row" style="width: 100%; display:flex; justify-content: center;">
            <!-- Circular image placeholder -->
            <label for="user_photo" class="circular-image-placeholder" id="previewImage" style="background-image: url('{{ asset('images/' . $employee->ProfilePicture) }}');">
                
            </label>
            <!-- File input (hidden) -->
            <input type="file" class="" id="user_photo" name="user_photo" onchange="displaySelectedImage(this)">
        </div>



        <div class="row">
            <div class="col-md-4">
                <label for="firstName" class="form-label fs-6">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="{{ $employee->FirstName }}" required>
            </div>

            <div class="col-md-4">
                <label for="middleName" class="form-label fs-6">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middle_name"  value="{{ $employee->MiddleName }}" required>
            </div>
            <div class="col-md-4">
                <label for="lastName" class="form-label fs-6">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name"  value="{{ $employee->LastName }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="email" class="form-label fs-6">Email</label>
                <input type="text" class="form-control" id="email" name="email"  value="{{ $employee->Email }}" required>
            </div>
            <div class="col-md-4">
                <label for="contactNumber" class="form-label fs-6">Contact Number</label>
                <input type="text" class="form-control" id="contactNumber" name="contact_number"  value="{{ $employee->ContactNumber }}" required>
            </div>
            <div class="col-md-2">
                <label for="position" class="form-label fs-6">Position</label>
                <select class="form-select" id="position" name="position" required>
                    <option disabled>Select Position</option>
                    <option value="lender" {{ $employee->Position === 'lender' ? 'selected' : '' }}>Lender</option>
                    <option value="collector" {{ $employee->Position === 'collector' ? 'selected' : '' }}>Collector</option>
                    <option value="auditor" {{ $employee->Position === 'auditor' ? 'selected' : '' }}>Auditor</option>
                </select>

            </div>
        </div>

         <div class="row">
            <div class="col-md-4">
                <label for="username" class="form-label fs-6">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $employee->userAccount->UserName }}" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label fs-6">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $employee->userAccount->Password }}" required>
            </div>

        </div>

        <div class="row" style="width: 100%; display:flex; justify-content: center;">
            <button type="submit" class="btn btn-primary">Edit Account</button>
        </div>


    
    </form>



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
                        const previewImage = document.getElementById('previewImage');
                        previewImage.style.backgroundImage = `url(${e.target.result})`;
                        previewImage.innerHTML = ''; // Clear any text content
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // No file selected, display the default image
                    const previewImage = document.getElementById('previewImage');
                    previewImage.style.backgroundImage = `url('{{ asset('images/' . $employee->ProfilePicture) }}')`;
                    previewImage.innerHTML = 'Upload Photo';
                }
            }




        </script>
@endsection

@endsection