@extends('index')
@section('content')


<h1 class="title">Borrower Information</h1>


<section class="table">
    <section class="table__header">
        <h1>Borrower</h1>
        <div class="sort-filter-search">
            <div class="sort-select">
                <span>Sort By:</span>  
                <select>
                    <option value="ascending">Ascending</option>
                    <option value="descending">Descending</option>
                </select>
            </div>
            <div class="filter-status">
                <span>Filter by Date:</span>  
                <select>
                    <option value="all">All</option>
                    <option value="approved">Latest</option>
                    <option value="pending">Oldest</option>
                    <option value="rejected">Custom</option>
                </select>
            </div>
            <div class="filter-evaluation">
                <span>Filter by Evaluation Area:</span>
                <select>
                    <option value="all">All</option>
                    <option value="income_evaluation">Koronadal</option>
                    <option value="payment_history_evaluation">Polomolok</option>
                    <option value="credit_investigator_approval">Tupi</option>
                    <option value="disbursement_approval">Surallah</option>
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
                    <th> Borrower</th>
                    <th> Business</th>
                    <th> Contact Number</th>
                    <th> Total Paid</th>
                    <th> Balance</th>
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

                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Zinzu Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                   <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Jeet Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Sonal Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Alson Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">John Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Jane Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                   <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Michael Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Emily Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
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
                    <td>
                        <div class="profile-info">
                            <div class="name-id">
                                <div class="name">Mark Sari-Sari Store</div>
                                <div class="id">Sari-Sari</div>
                            </div>
                        </div>
                    </td>
                    <td> 09122740427 </td>
                    <td> 5,000 </td>
                    <td> 1,000</td>
                    <td>
                        <button class="view-button">View</button>

                    </td>
                </tr>

            </tbody>
        </table>
    </section>
    
</section>


@endsection