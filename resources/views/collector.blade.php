@extends('index')
@section('content')


<h1 class="title">Collectors</h1>

<section class="tableContainer">
    <table id='collectorsTable'>
        <thead>
            <tr>
                <th>Collector</th>
                <th>Area</th>
                <th>Mobile Number</th>
                <th>Email</th>
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
                                        <div class="id">ID: {{ $collection->EmployeeID }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $collection->AreaAssigned }}</td>
                            <td>{{ $collection->ContactNumber }}</td>
                            <td>{{ $collection->Email }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#collection_{{ $collection->EmployeeID }}" class="button mr-3">Assign</a>
                                <button data-toggle="modal" data-target="#viewCollectionDetails_{{ $collection->EmployeeID }}" class="button">View</a>
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
                            <h5 class="modal-title">Assign Area</h5>
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
                                    <br>
                                    <h6 class="name font-weight-bold" style="font-size: 16px;">{{ $collection->CollectorName}}</h6>
                                    <p  style="font-size: 14px;">{{ $collection->AreaAssigned }}</p>
                                    @if ($collection)
                                    <form action="{{ route('assignArea', ['id' => $collection->EmployeeID]) }}" method="post">
                                        @csrf
                                        <div>
                                            <label for="assignArea" class="form-label font-weight-bold" style="font-size: 14px;">Assign Area</label>
                                            <select class="form-control" id="assignArea" name="assignArea" required>
                                                <option value="" selected disabled>Select an Area</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->AreaID }}">{{ $area->Area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="button mt-3" style="width: 100%; font-size: 15px;">Assign Area</button>
                                    </form>
                                    @else
                                        <p>Collection data is not available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($collections as $collection)
        @php
            $employeeID = $collection->EmployeeID;

            // Check if EmployeeID is greater than 0
            if ($employeeID > 0) {
                $numberOfBorrowers = DB::table('borrowers')
                    ->where('EmployeeID', $employeeID)
                    ->count();

                $totalPaymentAmount = DB::table('payments')
                    ->join('loans', 'payments.LoanID', '=', 'loans.LoanID')
                    ->join('borrowers', 'loans.BorrowerID', '=', 'borrowers.BorrowerID')
                    ->where('borrowers.EmployeeID', $employeeID)
                    ->sum('payments.PaymentAmount');

                $totalAmountDue = DB::table('loans')
                    ->join('borrowers', 'loans.BorrowerID', '=', 'borrowers.BorrowerID')
                    ->where('borrowers.EmployeeID', $employeeID)
                    ->sum('loans.TotalAmountDue');
                
                $totalCollectibles = $totalAmountDue - $totalPaymentAmount;

                $denominator = $totalCollectibles; // Use totalCollectibles as the denominator

                $collectionRate = 0; // Initialize to zero

                if ($denominator != 0) {
                    $collectionRate = round((($totalPaymentAmount / $denominator) * 100), 2);
                } else {
                    
                }
            } else {
               
            }




        @endphp

        <div class="modal fade" id="viewCollectionDetails_{{ $collection->EmployeeID }}" tabindex="-1" role="dialog" aria-labelledby="viewCollectionDetails" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="progressContainer">
                        <div class="modal-header">
                            <h5 class="modal-title">Collection Details</h5>
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
                                    <br>
                                    <h6 class="name font-weight-bold" style="font-size: 16px;">{{ $collection->CollectorName}}</h6>
            
                                    <div class="card">
                                        <div class="head text-left pl-4 pt-2">
                                            <div>
                                                <p style="font-size: 13px;">No. of Assigned Borrowers</p>
                                                <h2 style="font-size: 23px;">{{ $numberOfBorrowers }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="head text-left pl-4 pt-2">
                                            <div>
                                                <p style="font-size: 13px;">Total Collectibles</p>
                                                <h2 style="font-size: 23px;">{{ $totalCollectibles }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="head text-left pl-4 pt-2">
                                            <div>
                                                <p style="font-size: 13px;">Collection Rate</p>
                                                <h2 style="font-size: 23px;">{{$collectionRate }} %</h2>
                                            </div>
                                        </div>
                                    </div>



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
        let table = new DataTable('#collectorsTable');
    </script>
@endsection

@endsection