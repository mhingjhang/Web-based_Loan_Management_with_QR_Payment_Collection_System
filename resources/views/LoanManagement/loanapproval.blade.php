@extends('index')
@section('content')



<h1 class="title">Loan Approval</h1>

<section class="table">
     <h1>Pending Loan Applications</h1>
     <br>
    <livewire:loan-application-view-table />
</section>


{{-- TABLE 2 --}}
<section class="table">
     <h1>Approved Loan Applications</h1>
     <br>
    <livewire:loan-application-approved-view-table />
</section>


@endsection
