@extends('index')
@section('content')

<h1 class="title">Loan Disbursement</h1>

<div class="d-flex justify-content-center">
    <div class="card" style="border-radius: 20px; background: #D9D9D9;">
        <div class="card-body text-center d-flex" style="padding: 12px;">
            <div class="card mr-4" style="border-radius: 15px;">
                <div class="card-body text-center" style="padding: 10px;">
                    <div class="text-justify pr-2 pl-2">
                        <button class="button h6"  data-toggle="modal" data-target="#addfund" style="float: right; padding: 7px 14px; border-radius: 15px; margin: 20px 0 -10px 10rem;">+</button>
                        <p class="h6" style="font-weight: 400; margin-top: -16px;">Total Capital</p>
                        <p class="h1" style="font-weight: 600; margin-top: -10px; color: #004EDA;">{{ $totalAmount }}</p>
                    </div>
                </div>
            </div>
            <div class="card mr-3" style="background: #D9D9D9; border-radius: 15px; border: 0px solid #ff0000; transform: translate(0px, -5px);">
                <div class="card-body text-center" style="padding: 10px;">
                    <div class="text-justify pr-2 pl-2">
                        <br>
                        <br>
                        <p class="h6" style="font-weight: 400; margin-top: -16px;">Total Disbusement</p>
                        <p class="h1" style="font-weight: 600; margin-top: -10px; color: #004EDA;">{{ $totalDisbursement }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('modal_content')
    <!-- Add Fund Modal -->
    <div class="modal fade addfund" id="addfund" tabindex="-1" role="dialog" aria-labelledby="addfund" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="progressContainer">
                    <div class="modal-header">
                        <h5 class="modal-title">Add fund</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container-fluid p-4">
                        <form action="{{ route('addfund') }}" method="post">
                            @csrf
                            <div class="text-center">
                                <p class="tight-spacing font-weight-bold">Add fund Date: </p> 
                                <p>{{ date('Y-m-d') }}</p>
                            </div>
                            <div class="align-items-center">
                                <label for="addFund" class="form-label pr-2 font-weight-bold">Fund Amount</label>
                                <input type="text" class="form-control" id="addFund" name="addFund" placeholder="Enter Amount" required>
                            </div>
                            <button type="submit" class="button mt-3" style="width: 100%; font-size: 15px;">Add Fund</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disbursement Approval Modals -->
    @foreach ($approvals as $approval)
        <div class="modal fade approval" id="approval_{{ $approval->LoanApplicationID }}" tabindex="-1" role="dialog" aria-labelledby="approval" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="progressContainer">
                        <div class="modal-header">
                            <h5 class="modal-title">Disbursement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="container-fluid p-4">
                            <div class="row justify-content-center align-items-center">
                                <div class="col text-center">
                                    <div class="modal-image">
                                        <img src="{{ asset('images/' . $approval->loanApplication->client->BorrowerPhoto) }}" alt="">
                                    </div>
                                    <h6 class="name font-weight-bold mt-2" style="font-size: 18px;">{{ $approval->loanApplication->client->FirstName }} {{ $approval->loanApplication->client->LastName }}</h6>
                                    <p>{{ $approval->loanApplication->client->clientBusiness->TypeOfBusiness }}</p>
                                    <div class="text-justify pl-3" style="font-size: 14px;">
                                        <p class="tight-spacing"><span class="font-weight-bold">Requested Amount: </span>₱{{ $approval->loanApplication->Principal }}</p>
                                        <p class="tight-spacing"><span class="font-weight-bold">Requested Date: </span> {{ $approval->loanApplication->ApplicationDate }}</p>
                                        <p class="tight-spacing"><span class="font-weight-bold">Disbursement Date: </span> {{ date('Y-m-d') }}</p>
                                    </div>
                                    <form action="{{ route('disburse.store', ['id' => $approval->loanApplication->LoanApplicationID]) }}" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mt-3">
                                            <label for="disbursementAmount" class="form-label pr-2 font-weight-bold">Amount</label>
                                            <input type="text" class="form-control" id="disbursementAmount" name="disbursementAmount" placeholder="Enter Amount" required>
                                        </div>
                                        <button type="submit" class="button mt-3" style="width: 100%; font-size: 15px;">Disburse</button>
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

<br>

<section class="tableContainer">
    <!-- Pending Loan Applications Table -->
    <h1>Pending Loan Applications</h1>
    <table id='pendingTable'>
        <thead>
            <tr>
                <th>Clients</th>
                <th>Loan Amount</th>
                <th>Status</th>
                <th>Evaluation Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approvals as $approval)
                @if ($approval->approvalLevel->ApprovalLevel !== 'Disbursement Approval')
                    @continue
                @endif
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/' . $approval->loanApplication->client->BorrowerPhoto) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $approval->loanApplication->client->FirstName }} {{ $approval->loanApplication->client->LastName }}</div>
                                <div class="id">Loan Application ID: {{ $approval->loanApplication->LoanApplicationID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>₱{{ $approval->loanApplication->Principal }}</td>
                    <td>{{ $approval->loanApplication->Status }}</td>
                    <td>{{ $approval->approvalLevel->ApprovalLevel }}</td>
                    <td>
                        <button class="button" data-toggle="modal" data-target="#approval_{{ $approval->LoanApplicationID }}">Disburse</button>
                        <a href="{{ route('show-promissory-qrcode', ['id' => $approval->LoanApplicationID]) }}" class="button">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<br>

<section class="tableContainer">
    <!-- Approved Loan Applications Table -->
    <h1>Approved Loan Applications</h1>
    <table id='approvedTable'>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Business</th>
                <th>Loan Amount</th>
                <th>Disbursement Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/' . $loan->borrower->BorrowerPhoto) }}" alt="">
                            <div class="name-id">
                                <div class="name">{{ $loan->borrower->FirstName }} {{ $loan->borrower->LastName }}</div>
                                <div class="id">Loan ID: {{ $loan->LoanID }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">{{ $loan->borrower->business->BusinessName}}</div>
                                <div class="id">Business Type: {{ $loan->borrower->business->TypeOfBusiness }}</div>
                            </div>
                        </div>
                    </td>
                    <td>₱{{ $loan->Principal }}</td>
                    <td>{{ $loan->DisbursementDate}}</td>
                    <td>
                        <a href="{{ route('show-promissory-qrcode', ['id' => $loan->LoanID]) }}" class="button">View</a>
                        <button class="button">Done</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@section('javascript')
    <script>
        let table1 = new DataTable('#pendingTable');
        let table2 = new DataTable('#approvedTable');
    </script>
@endsection

@endsection
