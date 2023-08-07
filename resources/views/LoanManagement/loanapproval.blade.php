@extends('index')
@section('content')



<h1 class="title">Loan Approval</h1>


<section class="table">
    <section class="table__header">
        <h1>Pending Loan Applications</h1>
        <div class="sort-filter-search">
            <div class="sort-select">
                <span>Sort By:</span>  
                <select>
                    <option value="ascending">Ascending</option>
                    <option value="descending">Descending</option>
                </select>
            </div>
            <div class="filter-status">
                <span>Filter by Status:</span>  
                <select>
                    <option value="all">All</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="filter-evaluation">
                <span>Filter by Evaluation Status:</span>
                <select>
                    <option value="all">All</option>
                    <option value="income_evaluation">Income Evaluation</option>
                    <option value="payment_history_evaluation">Payment History Evaluation</option>
                    <option value="credit_investigator_approval">Credit Investigator Approval</option>
                    <option value="disbursement_approval">Disbursement Approval</option>
                </select>
            </div>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search...">
            </div>
        </div>
    </section>

    <br>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th> Borrowers</th>
                    <th> Loan Amount</th>
                    <th> Status</th>
                    <th> Evaluation Status</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loanApplications as $loanApplication)
                    @if ($loanApplication->Status === 'approved')
                        @continue
                    @endif
                    <tr>
                        <td>
                            <div class="profile-info">
                                <img src="{{ asset('storage/images/' . $loanApplication->loan->borrower->BorrowerPhoto) }}" alt="">
                                <div class="name-id">
                                    <div class="name">{{ $loanApplication->loan->borrower->FirstName }} {{ $loanApplication->loan->borrower->LastName }}</div>
                                    <div class="id">ID: {{ $loanApplication->loan->borrower->BorrowerID }}</div>
                                </div>
                            </div>
                        </td>

                        <td> ₱{{ $loanApplication->loan->Principal }}</td>
                        <td>{{ $loanApplication->Status }}</td>
                        <td>{{ $loanApplication->Approval }}</td>
                        <td>
                            <button class="view-button" wire:click="$emitTo('modal-component', 'showModal', {{ $loanApplication->LoanID }})">View</button>
                        </td>
                    </tr>
                @endforeach




       

            </tbody>
        </table>
    </section>

    <!-- Pagination links -->
    <div class="pagination-links">
        {{ $loanApplications->links() }}
    </div>
    
</section>

{{-- TABLE 2 --}}

<section class="table">
    <section class="table__header">
        <h1>Approved Loan Applications</h1>
        <div class="sort-filter-search">
            <div class="sort-select">
                <span>Sort By:</span>  
                <select>
                    <option value="ascending">Ascending</option>
                    <option value="descending">Descending</option>
                </select>
            </div>

            <div class="search-bar">
                <input type="text" id="search" placeholder="Search...">
            </div>
        </div>
    </section>

    <br>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th> Borrowers</th>
                    <th> Loan Amount</th>
                    <th> Status</th>
                    <th> Evaluation Status</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loanApplications as $loanApplication)
                    @if ($loanApplication->Status !== 'approved')
                        @continue
                    @endif
                    <tr>
                        <td>
                            <div class="profile-info">
                                <img src="{{ asset('storage/images/' . $loanApplication->loan->borrower->BorrowerPhoto) }}" alt="">
                                <div class="name-id">
                                    <div class="name">{{ $loanApplication->loan->borrower->FirstName }} {{ $loanApplication->loan->borrower->LastName }}</div>
                                    <div class="id">ID: {{ $loanApplication->loan->borrower->BorrowerID }}</div>
                                </div>
                            </div>
                        </td>

                        <td> ₱{{ $loanApplication->loan->Principal }}</td>
                        <td>{{ $loanApplication->Status }}</td>
                        <td>{{ $loanApplication->Approval }}</td>
                        <td>
                            <button class="view-button" wire:click="$emitTo('modal-component', 'showModal', {{ $loanApplication->LoanID }})">View</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>
    {{ $loanApplications->links() }}
    
</section>


@endsection
