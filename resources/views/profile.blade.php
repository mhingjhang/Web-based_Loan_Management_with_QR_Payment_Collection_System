@extends('index')
@section('content')

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center">
    <h1 class="title">Profile</h1>
    <div class="d-flex">

        <a href="{{route('showEditAccount')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Edit Account</a>
        <a href="{{route('showCreateAccount')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Create Account</a>
       
        <button class="btn btn-primary" style="border-radius: 10px;">Print</button>
    </div>
    
</div>


<br>

<section class="tableContainer">
    <table id='profileTable'>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Date</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                @if ($employee->Status === 'Inactive')
                    @continue
                @endif
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('storage/images/' . ($employee->ProfilePicture ? $employee->ProfilePicture : 'profilepic.png')) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $employee->FirstName }} {{ $employee->LastName }}</div>
                                <div class="id">Employee ID: {{ $employee->EmployeeID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $employee->ContactNumber }}</td>
                    <td>{{ $employee->Email }}</td>
                    <td>{{ $employee->userAccount->DateCreated }}</td>
                    <td>{{ $employee->Position}}</td>
                    <td>
                        <button class="button" data-toggle="modal" data-target="#employee{{ $employee->EmployeeID }}">Deativate</button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</section>


@section('modal_content')
@foreach ($employees as $employee)

    <div class="modal" id="employee{{ $employee->EmployeeID }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deactivate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate this employee?.</p>
                </div>
                
                <div class="modal-footer">
                    @if ($employee->EmployeeID)
                        <a href="{{ route('deactivateAccount', ['id' => $employee->EmployeeID]) }}" class="btn btn-primary">Deactivate</a>
                    @else
                        <span class="text-danger">No ID available</span>
                    @endif
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection







@section('javascript')
        <script>
            let table = new DataTable('#profileTable');

            function goBack() {
                window.history.back();
            }

        </script>
@endsection

@endsection