@extends('index')
@section('content')

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center">
    <h1 class="title">Void Transactions</h1>
    <div class="d-flex">
        <button class="btn btn-primary mr-3" style="border-radius: 10px;" onclick="goBack()">Back</button>
        <button class="btn btn-primary mr-3" style="border-radius: 10px;">Add Repayment</button>
        
      <a href="{{route('showVoidTransaction')}}" class="btn btn-primary mr-3" style="border-radius: 10px;">Void Tranactions</a>
       
        <button class="btn btn-primary" style="border-radius: 10px;">Print</button>
    </div>
    
</div>

<br>

<section class="tableContainer">
    <table id='repaymentTable'>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
                <th>Payment Amount</th>
                <th>Collector</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repayments as $repayment)
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('storage/images/' . ($repayment->loan->borrower->BorrowerPhoto ? $repayment->loan->borrower->BorrowerPhoto : 'profilepic.png')) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $repayment->loan->borrower->FirstName }} {{ $repayment->loan->borrower->LastName }}</div>
                                <div class="id">Loan ID: {{ $repayment->loan->LoanID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $repayment->PaymentDate}} {{ $repayment->PaymentID}}</td>
                    <td>₱{{ $repayment->PaymentMethod }}</td>
                    <td>₱{{ $repayment->PaymentAmount }}</td>
                    <td>{{ $repayment->employee->FirstName}} {{ $repayment->employee->LastName}}</td>
                    <td>
                        <button class="button" data-toggle="modal" data-target="#repayment_{{ $repayment->PaymentID }}">Approve Void</button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>


</section>


@section('modal_content')
@foreach ($repayments as $repayment)

    <div class="modal" id="repayment_{{ $repayment->PaymentID }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Void</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to void this transaction?.</p>
                </div>
                
                <div class="modal-footer">
                    @if ($repayment->PaymentID)
                        <a href="{{ route('approveVoid', ['id' => $repayment->PaymentID]) }}" class="btn btn-primary">Approve Void</a>
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
            let table = new DataTable('#repaymentTable');

        </script>
@endsection

@endsection