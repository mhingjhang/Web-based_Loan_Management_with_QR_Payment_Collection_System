@extends('index')

@section('content')

    <h1 class="title">Loan Approval</h1>

<section class="tableContainer">
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
                @if ($approval->approvalLevel->ApprovalLevel === 'Ready for Disbursement')
                        @continue;
                @endif
                    <tr>
                        <td>
                            <div class="profile-info">
                                <img src="{{ asset('storage/images/' . $approval->loanApplication->client->BorrowerPhoto) }}" alt="">
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
                           <button class="button" data-toggle="modal" data-target="#approval-{{ $approval->ApprovalID }}">View</button>
                        </td>
                    </tr>
                @endforeach

                @section('modal_content')
                    @foreach ($approvals as $approval)
                        <div class="modal fade approvalstatus" id="approval-{{ $approval->ApprovalID }}" tabindex="-1" role="dialog" aria-labelledby="approvalstatus" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="progressContainer">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Loan Evaluation Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                

                                        <nav class="approvalProgressBar">
                                            <ul>
                                                <li>
                                                    <a href="#" class="{{ $approval->ApprovalLevelID >= 1 ? 'active' : '' }}">
                                                        Borrower and Income Evaluation
                                                    </a>
                                                    <p>Evaluating borrower and income information</p>
                                                </li>
                                                <li>
                                                    <a href="#" class="{{ $approval->ApprovalLevelID >= 2 ? 'active' : '' }}">
                                                        Payment History Evaluation
                                                    </a>
                                                    <p>Assessing borrower's payment history</p>
                                                </li>
                                                <li>
                                                    <a href="#" class="{{ $approval->ApprovalLevelID >= 3 ? 'active' : '' }}">
                                                        CI Approval
                                                    </a>
                                                    <p>Credit Investigator verifies your information</p>
                                                </li>
                                                <li>
                                                    <a href="#" class="{{ $approval->ApprovalLevelID >= 4 ? 'active' : '' }}">
                                                        Disbursement Approval
                                                    </a>
                                                    <p>Checking if the company has sufficient fund</p>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endsection
            </tbody>
        </table>

       
    </section>
    <br>
    <section class="tableContainer">
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
                                <img src="{{ asset('storage/images/' . $loan->borrower->BorrowerPhoto) }}" alt="">
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
