<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<!-- CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	

	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="{{ asset('css/approvalProgressBar.css') }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{ asset('css/tablestyle.css') }}">
	<link rel="stylesheet" href="{{ asset('css/addrepayment.css') }}">
	<link rel="stylesheet" href="{{ asset('css/createAccount.css') }}">
	<title>Loan Managment System</title>

	@yield('css_styles')

	<style>
		[x-cloak] { display: none !important; }
	</style>
	@livewireStyles
</head>
<body>

	@php
        $userId = Auth::id();

        // Use the user ID to fetch the corresponding Employee data
        $employee = \App\Models\Employee::where('UserAccountID', $userId)->first();

        if (!$employee) {
            // Handle the case where no corresponding Employee record is found
            // You can redirect with an error message or handle it as needed.
            $errorMessage = 'Employee record not found.';
        }
    @endphp
	
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><img src="{{ asset('images/logo.png') }}" alt=""> Three Fe's Appliance Emporium</a>
		<ul class="side-menu">
			<li>
				<div class="profile-info">
					@if (isset($employee))
                    <img src="{{ asset('images/' . $employee->ProfilePicture) }}" alt="" style="width: 35px; height: 35px;">
                        <div class="name-id">
                            <div style="font-size: 15px; font-weight: bold;">{{ $employee->FirstName }}</div>
                            <div style="font-size: 12px;">Position: {{ $employee->Position }}</div>
                        </div>
					@else
						<p>{{ $errorMessage }}</p>
					@endif
                </div>
			</li>
			<hr>
			<li><a href="{{ route('dashboard') }}" class="dashboard-link"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bx-money icon'></i> Loans <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="{{ route('loanapplication') }}">Loan Application</a></li>
					<li><a href="{{ route('loanapproval') }}">Loan Approval</a></li>
					<li><a href="{{ route('loandisbursement') }}">Loan Disbursement</a></li>
					<li><a href="{{ route('collection') }}">Collection</a></li>
					<li><a href="{{ route('borrower') }}">Borrower</a></li>
					<li><a href="{{ route('loaninformation') }}">Loan Information</a></li>
					<li><a href="{{ route('repayment') }}">Repayment</a></li>
				</ul>
			</li>
			<li><a href="{{ route('collector') }}"><i class='bx bxs-group icon' ></i> Collectors</a></li>
			<li>
				<a href="#"><i class='bx bx-line-chart icon'></i> Reports <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="#">Loan Application</a></li>
					<li><a href="#">Outstanding Balance</a></li>
					<li><a href="#">Loan Portfolio</a></li>
					<li><a href="#">Delinquency</a></li>
					<li><a href="#">Disbursement</a></li>
					<li><a href="#">Collectors</a></li>
					<li><a href="#">Gross Income</a></li>
				</ul>
			</li>
			<li class="divider" data-text="Users">Users</li>
			<li><a href="{{ route('profile') }}"><i class='bx bxs-user icon'></i> Profile</a></li>
			<li><a href="{{ route('login') }}"><i class='bx bx-log-out icon'></i> Logout</a></li>
		</ul>
		
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>

		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!--Content-->
			@yield('content')

			@yield('modal_content')
			
		</main>

		
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->






	
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="{{ asset('js/modal.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	@yield('javascript')

	
	@livewireScripts

	
</body>
</html>