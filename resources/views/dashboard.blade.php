@extends('index')
@section('content')

<h1 class="title">Dashboard</h1>
			<div class="info-data">

				{{-- Dashboard Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Borrowers</p>
							<h2>1500</h2>
							
						</div>
					</div>
				
				</div>

				{{-- Disbursement Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Disbursement</p>
							<h2>234</h2>
						</div>
					</div>
					
				</div>

				{{-- Total Collection Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Total Collection</p>
							<h2>465</h2>
						</div>
					</div>
					
				</div>

				{{-- Accounts Receivable Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Accounts Receivable</p>
							<h2>235</h2>
						</div>
					</div>
				</div>

				{{-- Open Loans Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Open Loans</p>
							<h2>1500</h2>
							
						</div>
					</div>
				
				</div>

				{{-- Fully Paid Loans Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Fully Paid Loans</p>
							<h2>234</h2>
						</div>
					</div>
					
				</div>

				{{-- Restructured Loans Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Restructured Loans</p>
							<h2>465</h2>
						</div>
					</div>
					
				</div>

				{{-- Defaulted Loans Card --}}
				<div class="card">
					<div class="head">
						<div>
							<p>Defaulted Loans</p>
							<h2>235</h2>
						</div>
					</div>
					
				</div>
			</div>

            <div class="data">
						<div class="content-data">
							<div class="head">
								<h3>Disbursement</h3>
								<div class="menu">
									<i class='bx bx-dots-horizontal-rounded icon'></i>
									<ul class="menu-link">
										<li><a href="#">Edit</a></li>
										<li><a href="#">Save</a></li>
										<li><a href="#">Remove</a></li>
									</ul>
								</div>
							</div>
							<div class="chart">
								<div id="chart"></div>
							</div>
						</div>	

                        <div class="content-data">
							<div class="head">
								<h3>Collections</h3>
								<div class="menu">
									<i class='bx bx-dots-horizontal-rounded icon'></i>
									<ul class="menu-link">
										<li><a href="#">Edit</a></li>
										<li><a href="#">Save</a></li>
										<li><a href="#">Remove</a></li>
									</ul>
								</div>
							</div>
							<div class="chart">
								<div id="chart2"></div>
							</div>
						</div>	

                        <div class="content-data">
							<div class="head">
								<h3>Accounts Receivable</h3>
								<div class="menu">
									<i class='bx bx-dots-horizontal-rounded icon'></i>
									<ul class="menu-link">
										<li><a href="#">Edit</a></li>
										<li><a href="#">Save</a></li>
										<li><a href="#">Remove</a></li>
									</ul>
								</div>
							</div>
							<div class="chart">
								<div id="chart3"></div>
							</div>
						</div>	

                        <div class="content-data">
							<div class="head">
								<h3>Borrowers</h3>
								<div class="menu">
									<i class='bx bx-dots-horizontal-rounded icon'></i>
									<ul class="menu-link">
										<li><a href="#">Edit</a></li>
										<li><a href="#">Save</a></li>
										<li><a href="#">Remove</a></li>
									</ul>
								</div>
							</div>
							<div class="chart">
								<div id="chart4"></div>
							</div>
						</div>	


			</div>

			
			

					

					
			</div>


@endsection
			
			