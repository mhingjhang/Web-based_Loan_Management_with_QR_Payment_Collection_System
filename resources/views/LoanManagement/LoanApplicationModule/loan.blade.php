@extends('index')
@section('content')

<form action="{{ route('loanapplication.saveLoanInformation') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <h1 class="title">Loan Application</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" onclick="history.back();" class="btn btn-primary mr-4">Back</button>
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </div>

    <h2 class="subtitle">Loan Information</h2>

    <div class="container">
        <div class="loanAmountContainer">
            <div class="row">
                <label for="loanAmount" class="form-label fs-6">Loan Amount</label>
                <input class="fc form-control" type="number" id="loanAmount" name="loanAmount" min="0" value="0.00">
            </div>

            <div class="row">
                <label class="form-label fs-6">Loan Amount Range</label>
                <input type="range" class="slider" id="loanAmountRange" name="loanAmountRange" min="0" max="5000" step="100" value="0.00">
            </div>

            <div class="calculation-form">
                <div class="r">
                    <label for="loanAmountResult">Loan Amount</label>
                    <input type="text" id="loanAmountResult" name="loanAmountResult" value="0.00" readonly>
                </div>
                <div class="r">
                    <label for="interest">Interest</label>
                    <input type="text" id="interest" name="interest" readonly value="0.00">
                </div>
                <hr>
                <div class="r">
                    <label for="total">Total</label>
                    <input type="text" id="total" name="total" readonly class="result" value="0.00">
                </div>
            </div>
        </div>

        <div class="rightcontainer">
            <div class="r">
                <label for="loanDuration">Loan Duration (days)</label>
                <input type="text" id="loanDuration" name="loanDuration" min="0" value="60">
            </div>
            <div class="r">
                <label for="dailyRepayment">Daily Repayment</label>
                <input type="text" id="dailyRepayment" name="dailyRepayment" readonly value="0.00">
            </div>
            <br>
            <br>
            <div class="r">
                <label for="loanAmount">Loan Amount</label>
                <input type="text" id="loanAmount2" name="loanAmount2" readonly value="0.00">
            </div>
            <div class="r">
                <label for="serviceFee">Service Fee</label>
                <input type="text" id="serviceFee" name="serviceFee" readonly value="0.00">
            </div>
            <hr>
            <div class="r">
                <label for="totalDisbursement">Total Disbursement</label>
                <input type="text" id="totalDisbursement" name="totalDisbursement" readonly class="result" value="0.00">
            </div>
        </div>
    </div>
</form>

@endsection
