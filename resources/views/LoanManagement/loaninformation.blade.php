@extends('index')
@section('content')


<h1 class="title">Loan Information</h1>

<section class="tableContainer">
    <table id='loanTable'>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Release Date</th>
                <th>Principal</th>
                <th>Interest</th>
                <th>Due</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('storage/images/' . ($loan->borrower->BorrowerPhoto ? $loan->borrower->BorrowerPhoto : 'profilepic.png')) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $loan->borrower->FirstName }} {{ $loan->borrower->LastName }}</div>
                                <div class="id">Loan ID: {{ $loan->LoanID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $loan->DisbursementDate}}</td>
                    <td>₱{{ $loan->Principal }}</td>
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">{{ $loan->InterestRate * 100 }}%/Month</div>
                                <div class="id">Business Type: {{ $loan->Interest }}</div>
                            </div>
                        </div>
                    </td>
                    <td>₱{{ $loan->TotalAmountDue }}</td>
                    <td>
                        <a href="{{ route('showLoanInformation', ['id' => $loan->LoanID]) }}" class="button">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>



    @section('javascript')
        <script>
            let table = new DataTable('#loanTable');

        </script>
    @endsection

@endsection