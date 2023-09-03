@extends('index')
@section('content')


<h1 class="title">Borrower Information</h1>

<section class="tableContainer">
    <table id='borrowerTable'>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Business</th>
                <th>Mobile Number</th>
                <th>Total Amount Due</th>
                <th>Total Paid</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/' . ($payment->BorrowerPhoto ? $payment->BorrowerPhoto : 'profilepic.png')) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $payment->Borrowers }}</div>
                                <div class="id">Loan ID: {{ $payment->LoanID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">{{ $payment->BusinessName }}</div>
                                <div class="id">Business Type: {{ $payment->TypeOfBusiness }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $payment->ContactNumber }}</td>
                    <td>₱{{ $payment->TotalAmountDue }}</td>
                    <td>₱{{ $payment->TotalPaid }}</td>
                    <td>₱{{ $payment->Balance }}</td>
                    <td>
                        <a href="{{ route('showBorrowerInformation', ['id' => $payment->LoanID]) }}" class="button">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>



    @section('javascript')
        <script>
            let table = new DataTable('#borrowerTable');

        </script>
    @endsection

@endsection