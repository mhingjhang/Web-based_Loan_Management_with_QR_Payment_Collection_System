@extends('index')
@section('content')

<h1 class="title">Loan Disbursement</h1>
{{-- 
<div class="outer-rectangle">
    Total Disbursement
    <div>10,000</div>
    <div class="inner-rectangle">
      <span class="plus-sign">+</span>
      Capital
      <div>10,000</div>
    </div>
  </div> --}}

<section class="table">
    <section class="table__header">
        <h1>Pending Loan Applications</h1>
        <div class="sort-filter-search">
            <div class="sort-select">
                <span>Sort By:</span>  
                <select>
                    <option value="borrowers">Borrowers</option>
                    <option value="loan_amount">Loan Amount</option>
                    <option value="status">Status</option>
                    <option value="evaluation_status">Evaluation Status</option>
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
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Zinzu Chan Lee.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Zinzu Chan Lee</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>

                    <td> ₱128.90 </td>
                    <td>Approved</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>

               <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Jeet Saru.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Jeet Saru</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱5350.50</td>
                    <td class="status pending">Pending</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sonal Gharti.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Sonal Gharti</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱210.40</td>
                    <td class="status rejected">Rejected</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Alson GC.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Alson GC</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱149.70</td>
                    <td class="status approved">Approved</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <!-- Additional rows -->
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Jeet Saru.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">John Doe</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱250.00</td>
                    <td class="status approved">Approved</td>
                    <td>
                       <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sonal Gharti.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Jane Smith</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱500.00</td>
                    <td class="status pending">Pending</td>
                   <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Zinzu Chan Lee.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Michael Johnson</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱1000.00</td>
                    <td class="status rejected">Rejected</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sarita Limbu.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Emily Davis</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱750.00</td>
                    <td class="status approved">Approved</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>   
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Alson GC.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Mark Anderson</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱300.00</td>
                    <td class="status pending">Pending</td>
                    <td>
                        <button class="done-button">Disburse</button>
                        <button class="view-button">View</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </section>
    
</section>


<section class="table">
    <section class="table__header">
        <h1>Approved Loan Applications</h1>
        <div class="sort-filter-search">
            <div class="sort-select">
                <span>Sort By:</span>  
                <select>
                    <option value="borrowers">Borrowers</option>
                    <option value="loan_amount">Loan Amount</option>
                    <option value="status">Status</option>
                    <option value="evaluation_status">Evaluation Status</option>
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
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Zinzu Chan Lee.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Zinzu Chan Lee</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>

                    <td> ₱128.90 </td>
                    <td>Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>

               <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Jeet Saru.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Jeet Saru</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱5350.50</td>
                    <td class="status pending">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sonal Gharti.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Sonal Gharti</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱210.40</td>
                    <td class="status rejected">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Alson GC.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Alson GC</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱149.70</td>
                    <td class="status approved">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <!-- Additional rows -->
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Jeet Saru.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">John Doe</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱250.00</td>
                    <td class="status approved">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sonal Gharti.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Jane Smith</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱500.00</td>
                    <td class="status pending">Approved</td>
                   <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Zinzu Chan Lee.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Michael Johnson</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱1000.00</td>
                    <td class="status rejected">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Sarita Limbu.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Emily Davis</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱750.00</td>
                    <td class="status approved">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>   
                </tr>
                <tr>
                    <td>
                        <div class="profile-info">
                            <img src="{{ asset('images/Alson GC.jpg') }}" alt="">
                            <div class="name-id">
                                <div class="name">Mark Anderson</div>
                                <div class="id">ID: XXXXXXXX</div>
                            </div>
                        </div>
                    </td>
                    <td>₱300.00</td>
                    <td class="status pending">Approved</td>
                    <td>
                        <button class="view-button">View</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </section>
    
</section>

@endsection