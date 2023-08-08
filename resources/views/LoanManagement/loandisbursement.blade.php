@extends('index')
@section('content')

<h1 class="title">Loan Disbursement</h1>

<div class="">

</div>

<section class="table">
     <h1>Pending Loan Applications</h1>
     <br>
    <livewire:disbursement-pending-view-table />
</section>

<section class="table">
     <h1>Approved Loan Applications</h1>
     <br>
    <livewire:disbursement-approved-view-table />
</section>

@endsection