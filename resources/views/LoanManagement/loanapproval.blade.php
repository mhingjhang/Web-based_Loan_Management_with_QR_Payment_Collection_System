@extends('index')
@section('content')



<h1 class="title">Loan Approval</h1>

<section class="tableContainer">
    <h1>Pending Loan Applications</h1>
    <br>
    <table id='pendingTable'>
            <thead>
                <tr>
                    <th> Clients</th>
                    <th> Loan Amount</th>
                    <th> Status</th>
                    <th> Evaluation Status</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($approvals as $approval)
                  
                   
                    <tr  data-levels="{{ implode(',', $approval->approvalLevel->pluck('ApprovalLevelID')->toArray()) }}">
                        <td>
                            <div class="profile-info">
                                <img src="{{ asset('storage/images/' . $approval->loanApplication->client->BorrowerPhoto) }}" alt="">
                                <div class="name-id">
                                    <div class="name">{{ $approval->loanApplication->client->FirstName }} {{ $approval->loanApplication->client->LastName }}</div>
                                    <div class="id">Loan Application ID: {{ $approval->loanApplication->LoanApplicationID }}</div>
                                </div>
                            </div>
                        </td>

                        <td> ₱{{ $approval->loanApplication->Principal }}</td>
                        <td>{{ $approval->loanApplication->Status }}</td>
                        <td>{{ $approval->approvalLevel->ApprovalLevel }}</td>
                        <td>
                            <button class="button" data-toggle="modal" data-target="#approval" onclick="viewApproval(this)">View</button>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>

</section>

<br>
{{-- TABLE 2 --}}
{{-- <section class="tableContainer">
     <h1>Approved Loan Applications</h1>
     <br>
    <livewire:loan-application-approved-view-table />
</section> --}}

@section('modal_content')

<div class="modal fade approvalstatus" id="approval" tabindex="-1" role="dialog" aria-labelledby="approvalstatus" aria-hidden="true">
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
                <li><a href="#" >Borrower and Income Evaluation</a><p>Evaluating borrower and income information</p></li>
                <li><a href="#" >Payment History Evaluation</a><p>Assessing borrower's payment history</p></li>
                <li><a href="#" >CI Approval</a><p>Credit Investigator verifies your information</p></li>
                <li><a href="#" >Disbursement Approval</a><p>Checking if the company has sufficient fund</p></li>
            </ul>
        </nav>

        </div>
        
    </div>
  </div>
</div>

@endsection


@section('javascript')
    <script>
        let table = new DataTable('#pendingTable');

        function viewApproval(button) {
            var row = button.closest('tr');
            var levels = row.dataset.levels.split(',').map(Number);

            var approvalList = document.querySelector('#approval .approvalProgressBar ul');
            approvalList.querySelectorAll('li').forEach(function(li, index) {
                if (levels.includes(index + 1)) {
                    li.querySelector('a').classList.add('active');
                } else {
                    li.querySelector('a').classList.remove('active');
                }
            });
        }

    </script>
@endsection

@endsection
