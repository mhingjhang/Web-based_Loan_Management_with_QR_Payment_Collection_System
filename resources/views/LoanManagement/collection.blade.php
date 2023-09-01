@extends('index')
@section('content')


<h1 class="title">Collection</h1>

<section class="tableContainer">
    <!-- Approved Loan Applications Table -->
    <h1>Approved Loan Applications</h1>
    <table id='collectionTable'>
        <thead>
            <tr>
                <th>Collector</th>
                <th>Date</th>
                <th>Actual Recorded Remittance</th>
                <th>Actual Amount Received</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($collections as $collection)
                    
                        <tr>
                            <td>
                                <div class="profile-info">
                                    <img src="{{ asset('storage/images/profilepic.png') }}" alt="">
                                    <div class="name-id">
                                        <div class="name">{{ $collection->CollectorName }} {{ $collection->EmployeeID }}</div>
                                        <div class="id">Area: {{ $collection->AreaAssigned }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $currentDate}}</td>
                            <td>₱{{ $collection->ActualRecordedAmount }}</td>
                            <td>₱{{ $collection->ActualAmountReceived }}</td>
                            <td>{{ $collection->Balance }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#collection_{{ $collection->EmployeeID }}" class="button">Add</a>
                            </td>
                        </tr>
                   
                @endforeach
            </tbody>
    </table>

@section('modal_content')
    @foreach ($collections as $collection)
        <div class="modal fade" id="collection_{{ $collection->EmployeeID }}" tabindex="-1" role="dialog" aria-labelledby="collection" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="progressContainer">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Remittance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="container-fluid p-4">
                            <div class="row justify-content-center align-items-center">
                                <div class="col text-center">
                                    <div class="modal-image">
                                        <img src="{{ asset('storage/images/profilepic.png') }}" alt="">
                                    </div>
                                    <h6 class="name font-weight-bold mt-2" style="font-size: 18px;">{{ $collection->CollectorName}}</h6>
                                    <p>{{ $collection->AreaAssigned }}</p>
                                    <form action="{{ route('collection.store', ['id' => $collection->EmployeeID]) }}" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mt-3">
                                            <label for="collectionAmount" class="form-label pr-2 font-weight-bold">Amount</label>
                                            <input type="text" class="form-control" id="collectionAmount" name="collectionAmount" placeholder="Enter Amount" required>
                                        </div>
                                        <button type="submit" class="button mt-3" style="width: 100%; font-size: 15px;">Add Remittance</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
</section>

@section('javascript')
    <script>
        let table = new DataTable('#collectionTable');
    </script>
@endsection

@endsection