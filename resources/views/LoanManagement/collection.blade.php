@extends('index')
@section('content')


<h1 class="title">Collection</h1>


<section class="table">
    <section class="table__header">
        <h1>Remittances</h1>
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
                    <th> Collector</th>
                    <th> Area</th>
                    <th> Date</th>
                    <th> Actual Recorded Remittance</th>
                    <th> Actual Amount Received</th>
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
                    <td> Koronadal </td>
                    <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
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
                    <td> Polomolok </td>
                    <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Surallah </td>
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Tupi </td>
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Koronadal </td>
                    <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Surallah </td>
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Tupi </td>
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
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
                    <td> Polomolok </td>
                     <td> 07-21-2023 </td>
                    <td>6,000</td>
                    <td> 6,000 </td>
                    <td> 0 </td>
                    <td><button class="view-button">View</button></td>
                </tr>

            </tbody>
        </table>
    </section>
    
</section>


@endsection