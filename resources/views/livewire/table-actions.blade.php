
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="button" data-toggle="modal" data-target="#approval">View</button>
</div>

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
                <li><a href="#" class="active">Borrower and Income Evaluation</a><p>Evaluating borrower and income information</p></li>
                <li><a href="#">Payment History Evaluation</a><p>Assessing borrower's payment history</p></li>
                <li><a href="#">CI Approval</a><p>Credit Invesitgator verifies your information</p></li>
                <li><a href="#">Disbursement Approval</a><p>Checking if the company has sufficient fund</p></li>
            </ul>
        </nav>    

        </div>
        
    </div>
  </div>
</div>

@endsection
