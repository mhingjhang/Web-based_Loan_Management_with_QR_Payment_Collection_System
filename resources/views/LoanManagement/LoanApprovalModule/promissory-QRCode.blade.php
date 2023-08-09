@extends('index')
@section('content')

<h1 class="title">Loan Approval</h1>

<h1 class="subtitle">Promissory Note</h1>

<div class="card m-4 p-4">
    <div class="card-body">
        @foreach ( $loanApplications as $loanApplication)
            <h5 class="card-title text-center font-weight-bold">Promissory Note</h5>

            <p class="text-justified">
                I, Mr. <span class="font-weight-bold">{{ $loanApplication->loan->borrower->FirstName }} {{ $loanApplication->loan->borrower->MiddleName }} {{ $loanApplication->loan->borrower->LastName }}</span>  hereby promise to pay <span class="font-weight-bold">Mr. Francis Raymund G. Pagota</span>, the amount of <span class="font-weight-bold">P 6,000 - Six Thousand Pesos</span> on term/s stated below.
            </p>

            <p>
                Daily Installments <span class="font-weight-bold">P 100 - Two Hundred Pesos</span> only. Within <span class="font-weight-bold">60 days</span> . Starting date <span class="font-weight-bold">July 31, 2022</span> , Due date <span class="font-weight-bold">September 29, 2022</span>.
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
            
        @endforeach
        
    </div>
</div>



@endsection