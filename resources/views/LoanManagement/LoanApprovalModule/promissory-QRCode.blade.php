@extends('index')
@section('content')

@section('css_stylesz')

<style>

    .wrap-text {
        width: 200px;
        height: auto;
        white-space: normal;
        overflow-wrap: break-word;
    }

    
</style>


@endsection

<h1 class="title">Loan Approval</h1>

<h1 class="subtitle">Promissory Note</h1>

 @foreach ( $loans as $loan)
<div class="card m-4 p-4">
    <div class="card-body">
       
            <h5 class="card-title text-center font-weight-bold">Promissory Note</h5>

            <p class="text-justified">
                I, Mr. <span class="font-weight-bold">{{ $loan->borrower->FirstName }} {{ $loan->borrower->MiddleName }} {{ $loan->borrower->LastName }}</span>  hereby promise to pay <span class="font-weight-bold">Mr. Francis Raymund G. Pagota</span>, the amount of <span class="font-weight-bold">P {{ $loan->Principal }}</span> on term/s stated below.
            </p>

            <p>
                Daily Installments <span class="font-weight-bold">P {{ $loan->DailyRepayment }}</span> only. Within <span class="font-weight-bold">{{ $loan->DurationDays }} days</span> . Starting date <span class="font-weight-bold">{{ $loan->EffectiveDate }}</span> , Due date <span class="font-weight-bold">{{ $loan->MaturityDate }}</span>.
            </p>

            <p>
                Failure to comply my promise on my given term. I shall be restructure my remaining account balance for every overdue with the same term and donation above.
            </p>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center font-weight-bold">Mr. Francis Eljohn S. Pagota<br>Lender</p>
                </div>
                <div class="col-md-6">
                    <p class="text-center font-weight-bold">Mr. Brad Simmons<br>Borrower</p>
                </div>
            </div>
            
      
        
    </div>
</div>

<h1 class="subtitle">QR Code</h1>

<div class="d-flex justify-content-center">
    <div class="card" style="border-radius: 15px;">
        <div class="card-body text-center" style="padding: 35px;">
            <div class="qr-code">
                @php
                    $name = $loan->borrower->FirstName . ' ' . $loan->borrower->MiddleName . ' ' . $loan->borrower->LastName;
                @endphp
                {{ QrCode::size(200)->generate($name); }}
            </div>
            <div class="mt-3">
                <p class="mb-0 h5 font-weight-bold wrap-text">Name: {{ $loan->borrower->FirstName }} {{ $loan->borrower->MiddleName }} {{ $loan->borrower->LastName }}</p>
                <p class="h5">ID: {{ $loan->LoanID }}</p>
            </div>
        </div>
    </div>
</div>


@endforeach

@endsection