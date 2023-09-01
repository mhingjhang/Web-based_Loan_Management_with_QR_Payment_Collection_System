@extends('index')
@section('content')


<div class="d-flex justify-content-between align-items-center">
    <h1 class="title">Payment History</h1>
    <div class="d-flex">
        <button class="btn btn-primary mr-3" style="border-radius: 10px;" onclick="goBack()">Back</button>
        <button class="btn btn-primary" style="border-radius: 10px;">Print</button>
    </div>
    
</div>


<div class="info-data">

    {{-- Dashboard Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Total Principal Earned</p>
                <h2>{{ $totalPrincipalEarned }}</h2>
            </div>
        </div>
    </div>

    {{-- Disbursement Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Total Interest Earned</p>
                <h2>{{ $totalInterestEarned }}</h2>
            </div>
        </div>
    </div>

    {{-- Total Collection Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Total Payment</p>
                <h2>{{ $totalPayment }}</h2>
            </div>
        </div>
    </div>

    {{-- Accounts Receivable Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Total Balance</p>
                <h2>{{ $totalBalance }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="info-data">
    {{-- Open Loans Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>No. of Payments</p>
                <h2>{{ $countOfPayments }}</h2>
            </div>
        </div>
    </div>

    {{-- Fully Paid Loans Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>No. of Missed Payment</p>
                <h2>{{ $countOfMissedPayments }}</h2>
            </div>
        </div>
    </div>

    {{-- Restructured Loans Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Remaining Days</p>
                <h2>{{ $remainingDays }}</h2>
            </div>
        </div>
    </div>

    {{-- Defaulted Loans Card --}}
    <div class="card">
        <div class="head">
            <div>
                <p>Maturity Date</p>
                <h2>{{ $remainingDays }}</h2>
            </div>
        </div>
    </div>
</div>


        <br>

<section class="tableContainer">
    <table id='paymentHistoryTable'>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Payment Date</th>
                <th>Principal Earned</th>
                <th>Interest Earned</th>
                <th>Payment Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('storage/images/' . ($payment->loan->borrower->BorrowerPhoto ? $payment->loan->borrower->BorrowerPhoto : 'profilepic.png')) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $payment->loan->borrower->FirstName }} {{ $payment->loan->borrower->LastName }}</div>
                                <div class="id">Loan ID: {{ $payment->loan->LoanID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $payment->PaymentDate}}</td>
                    <td>₱{{ $payment->PrincipalEarned }}</td>
                    <td>₱{{ $payment->InterestEarned }}</td>
                    <td>₱{{ $payment->PaymentAmount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>



    @section('javascript')
        <script>
            let table = new DataTable('#paymentHistoryTable');

        </script>
    @endsection

@endsection