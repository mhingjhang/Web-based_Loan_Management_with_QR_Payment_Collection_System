@extends('index')
@section('content')

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<form action="{{ route('addRepayment') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <h1 class="title">Add Payment</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" onclick="history.back();" class="btn btn-primary mr-4">Back</button>
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </div>

    <div class="container" style="padding:20px;">
        <div class="repaymentContainer">

        <div class="row">
            <div class="col">
                <label for="loanID" class="form-label fs-6">Loan ID</label>
                <input class="fc form-control" type="text" id="loanID" name="loanID" value="">
            </div>

            <div class="col">
                <label for="name" class="form-label fs-6">Name</label>
                <input class="fc form-control" type="text" id="name" name="name" value="">
            </div>


            <div>
                <div style="display: flex; justify-content: center; align-items: center; height: 100%; margin-top: 11px;">
                    <button type="button" data-toggle="modal" data-target="#borrowers" style="border: 0px solid white;"><i class="bx bxs-folder" style="font-size: 30px; color: #004EDA;"></i></a>
                </div>
            </div>
            <div class="col">
                <label for="payment" class="form-label fs-6">Payment</label>
                <input class="fc form-control" type="number" id="payment" name="payment" min="0" value="0.00">
            </div>
            <div class="col">
                <label for="paymentDate" class="form-label fs-6">Payment Date</label>
                <input class="fc form-control" type="date" id="paymentDate" name="paymentDate">
            </div>

        </div>


            <div class="repayment-calculation-form">
                <div class="r">
                    <label for="outstandingBalance">Outstanding Balance:</label>
                    <input type="text" id="outstandingBalance" name="outstandingBalance" value="0.00" readonly>
                </div>
                <div class="r">
                    <label for="repaymentAmount">Repayment Amount:</label>
                    <input type="text" id="repaymentAmount" name="repaymentAmount" readonly value="0.00">
                </div>
                <hr>
                <div class="r">
                    <label for="totalOutstandingBalance">Total Outstanding Balance:</label>
                    <input type="text" id="totalOutstandingBalance" name="totalOutstandingBalance" readonly class="result" value="0.00">
                </div>
                <br>
                <div class="r">
                    <label for="totalRepayment">Payment Balance:</label>
                    <input type="text" id="paymentBalance" name="totalRepayment" value="0.00" readonly>
                </div>
                <div class="r">
                    <label for="repaymentAmount2">Repayment Amount:</label>
                    <input type="text" id="repaymentAmount2" name="repaymentAmount2" readonly value="0.00">
                </div>
                <hr>
                <div class="r">
                    <label for="totalRepaymentBalance">Total Repayment Balance:</label>
                    <input type="text" id="totalRepaymentBalance" name="totalRepaymentBalance" readonly class="result" value="0.00">
                </div>
            </div>

        </div>

    </div>
</form>

@section('modal_content')

<!-- Modal -->
<div class="modal fade" id="borrowers" tabindex="-1" role="dialog" aria-labelledby="borrowerstitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <section class="tableContainer borrowerRepCont">
            <table id='borrowersTable'>
                <thead>
                    <tr>
                        <th>Borrower</th>
                        <th>Birth Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr data-id="{{ $loan->LoanID }}">
                            <td>
                                <div class="profile-info">
                                    <img src="{{ asset('storage/images/' . ($loan->borrower->BorrowerPhoto ? $loan->borrower->BorrowerPhoto : 'profilepic.png')) }}" alt="">
                                    <div class="name-id">
                                        <div class="name">{{ $loan->borrower->FirstName }} {{ $loan->borrower->LastName }}</div>
                                        <div class="id">Loan ID: {{ $loan->LoanID }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $loan->LoanID}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>



        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')
<!-- Add this JavaScript code after your DataTable initialization -->
<!-- Add this JavaScript code after your DataTable initialization -->
<script>

    // Get references to the input elements


        // Get references to the input fields
    const paymentInput = document.getElementById('payment');
    const outstandingBalanceInput = document.getElementById('outstandingBalance'); // Get the input element
    const repaymentAmountInput = document.getElementById('repaymentAmount');
    const totalOutstandingBalanceInput = document.getElementById('totalOutstandingBalance');
    const paymentBalanceInput = document.getElementById('paymentBalance'); // Get the input element
    const repaymentAmountInput2 = document.getElementById('repaymentAmount2');
    const totalRepaymentBalanceInput = document.getElementById('totalRepaymentBalance');


        // Listen for changes in the "Payment" input
    paymentInput.addEventListener('input', () => {
            // Get the payment amount as a number
        const paymentAmount = parseFloat(paymentInput.value) || 0;

            // Get the outstanding balance from the input element's value
        const outstandingBalance = parseFloat(outstandingBalanceInput.value) || 0;

            // Calculate the Repayment Amount and Total Outstanding Balance
        const repaymentAmount = paymentAmount.toFixed(2);
        const totalOutstandingBalance = (outstandingBalance - paymentAmount).toFixed(2);

        const paymentBalance = parseFloat(paymentBalanceInput.value) || 0;
        const totalRepaymentBalance = (paymentBalance - paymentAmount).toFixed(2);

        repaymentAmountInput.value = repaymentAmount;
        totalOutstandingBalanceInput.value = totalOutstandingBalance;
        repaymentAmountInput2.value = repaymentAmount;
        totalRepaymentBalanceInput.value = totalRepaymentBalance;
    });
    
    const loanIDInput = document.getElementById('loanID');
    const paymentDateInput = document.getElementById('paymentDate');

    // Listen for changes in the "Loan ID" input
    loanIDInput.addEventListener('input', () => {
        // Check if the "Loan ID" input has content
        if (loanIDInput.value.trim() !== '') {
            // If it has content, enable the "Payment" and "Payment Date" inputs
            paymentInput.removeAttribute('disabled');
            paymentDateInput.removeAttribute('disabled');
        } else {
            // If it doesn't have content, disable the "Payment" and "Payment Date" inputs
            paymentInput.setAttribute('disabled', 'true');
            paymentDateInput.setAttribute('disabled', 'true');
        }
    });

        


    const currentDate = new Date().toISOString().split('T')[0];

    // Set the current date as the default value for the paymentDate input
    document.getElementById('paymentDate').value = currentDate;

    let table = new DataTable('#borrowersTable');

    // Add a click event listener to the table rows
    table.on('click', 'tbody tr', function () {
        // Get the clicked row's data-id attribute
        let loanID = $(this).data('id');

        // Use Ajax to fetch the loan data associated with the loanID
        $.ajax({
            url: "{{ route('get-loan-data', ':loanID') }}".replace(':loanID', loanID),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Populate the form fields with the fetched data
                $('#loanID').val(data.loanID);
                $('#name').val(data.name);
                $('#outstandingBalance').val(data.outstandingBalance);
                $('#paymentBalance').val(data.paymentBalance);

                // You can also update other form fields as needed

                // Close the modal if needed
                $('#borrowers').modal('hide');
            },
            error: function () {
                alert('Error fetching loan data.');
            }
        });
    });
</script>


@endsection

@endsection
