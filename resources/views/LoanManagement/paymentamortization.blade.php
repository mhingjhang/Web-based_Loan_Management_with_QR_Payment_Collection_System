@extends('index')
@section('content')

<h1 class="title">Amortization table</h1>

<section class="tableContainer">
    <table id='paymentAmortizationTable'>
        <thead>
            <tr>
                <th>Payment Number</th>
                <th>Payment Date</th>
                <th>Payment Amount</th>
                <th>Principal</th>
                <th>Interest</th>
                <th>Total Interest</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedule as $row)
                <tr>
                    <td>{{ $row['payment_number'] }}</td>
                    <td>{{ $row['payment_date'] }}</td>
                    <td>₱{{ $row['payment_amount'] }}</td>
                    <td>₱{{ $row['principal'] }}</td>
                    <td>₱{{ $row['interest'] }}</td>
                    <td>₱{{ $row['totalInterest'] }}</td>
                    <td>₱{{ $row['remaining_amount'] }}</td>
                    
            
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('javascript')
        <script>
            let table = new DataTable('#paymentAmortizationTable');

        </script>
    @endsection
</section>


@endsection
