@extends('index')
@section('content')

<h1 class="title">Loan Disbursement</h1>

<div class="d-flex justify-content-center">
    <div class="card" style="border-radius: 15px; background: #D9D9D9;">
        <div class="card-body text-center d-flex" style="padding: 20px;">
           

                <div class="card" style="border-radius: 15px;">
                    <div class="card-body text-center" style="padding: 10px;">
                       <div class="CapitalContainer text-justify pr-4 pl-4">
                            <div class="CapitalHeader d-flex">
                                <p class="font-weight-bold mr-4 h6">Total Capital</p>
                                <button class="button h6" style="padding: 0px 10px; border-radius: 10px;">+</button>
                            </div>

                            <p class="h1 font-weight-bold">10,000</p>
                       </div>
                    </div>
                </div>

                <div class="card" style="border: 0px solid black; border-radius: 15px;">
                    <div class="card-body text-center" style="padding: 10px;">
                       <div class="CapitalContainer text-justify">
                            <div class="CapitalContainer text-justify">
                                <p>Total Disbursement</p>
                                <p>10,000</p>
                            </div>
                       </div>
                    </div>
                </div>

        </div>
    </div>
</div>

<br>

<section class="tableContainer">
     <h1>Pending Loan Applications</h1>
     <br>
    <livewire:disbursement-pending-view-table />
</section>

<br>

<section class="tableContainer">
     <h1>Approved Loan Applications</h1>
     <br>
    <livewire:disbursement-approved-view-table />
</section>

@endsection