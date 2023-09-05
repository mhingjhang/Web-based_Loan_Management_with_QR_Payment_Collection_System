@extends('index')
@section('content')

@section('css_styles')
<style>

</style>


@endsection

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center width: 100%">
    <h1 class="title" style="width; 100%;">Loan Application Report</h1>
    <div class="d-flex align-items-center justify-content-between">
    <div class="col-md-6 d-flex align-items-center">
        <label for="period" class="form-label fs-6 flex-grow-1 flex-shrink-0">Generate Reports by:</label>
        <select class="form-select" id="period" name="period" required style="border-radius: 10px; padding: 5px; border: 1px solid #ccc;">
            <option selected value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div id="dateInputDaily" class="col-md-6 align-items-center" style="display: flex;">
        <label for="date" class="form-label fs-6 ml-2 flex-grow-1 flex-shrink-0 mr-2">Select Date:</label>
        <input type="date" class="form-control" id="date" name="date">
    </div>

    <div id="dateInputWeekly" class="col-md-6 align-items-center" style="display: none;">
        <label for="week" class="form-label fs-6 ml-2 flex-grow-1 flex-shrink-0 mr-2">Select Week:</label>
        <input type="week" class="form-control" id="week" name="week">
    </div>

    <div id="dateInputMonthly" class="col-md-6 align-items-center" style="display: none;">
        <label for="month" class="form-label fs-6 ml-2 flex-grow-1 flex-shrink-0 mr-2">Select Month:</label>
        <input type="month" class="form-control" id="month" name="month">
    </div>

    <div id="dateInputYearly" class="col-md-6 align-items-center" style="display: none;">
        <label for="yearly" class="form-label fs-6 ml-2 flex-grow-1 flex-shrink-0 mr-2">Select Yearly:</label>
        <input type="number" class="form-control" id="yearly" name="yearly" min="1900" max="2099">
    </div>
        
        </div>

        <div class="btn-group" role="group">
            <a href="{{ route('printPreviewLoanApplicationReport') }}" class="btn btn-primary" style="border-radius: 10px;">Print</a>
        </div>
    </div>

    
</div>


<div class="info-data">


    <div class="card">
        <div class="head">
            <div>
                <p>No. of Loan Applications</p>
                <h2 id='totalLoanApplications'></h2>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="head">
            <div>
                <p>Approved Applications</p>
                <h2 id='approvedLoanApplications'></h2>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="head">
            <div>
                <p>Rejected Applications</p>
                <h2 id='rejectedLoanApplications'></h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="head">
            <div>
                <p>Total Requested Amount</p>
                <h2 id='totalPrincipal'></h2>
            </div>
        </div>
    </div>


</div>

<br>

<section class="tableContainer">
    <table id='loanApplicationsTable'>

    </table>
</section>





@section('javascript')
        <script>

            // Get the current date in the format YYYY-MM-DD
            const currentDate = new Date().toISOString().slice(0, 10);

            // Set the current date as the value of the input element
            document.getElementById("date").value = currentDate;

            
           const table = $('#loanApplicationsTable').DataTable({
                columns: [
                    {
                        data: 'client',
                        title: 'Client Info',
                        render: function (data, type, row) {
                            // Check if the client data exists
                            if (data) {
                                // Define the custom HTML structure for the "Client Info" column
                                return `
                                    <td>
                                        <div class="profile-info">
                                            <img src="${data.BorrowerPhoto ? '{{ asset('images/') }}/' + data.BorrowerPhoto : '{{ asset('images/profilepic.png') }}'}" alt="">
                                            <div class="name-id">
                                                <div class="name">${data.FirstName} ${data.LastName}</div>
                                                <div class="id">Loan ID: ${row.LoanApplicationID}</div>
                                            </div>
                                        </div>
                                    </td>
                                `;
                            } else {
                                return ''; // Return an empty string if client data is missing
                            }
                        },
                    },
                    { data: 'ApplicationDate', title: 'Application Date' },
                    { data: 'Principal', title: 'Principal' },
                    { data: 'Status', title: 'Status' },
                    {
                        title: 'Actions',
                        data: null,
                        render: function (data, type, row) {
                            // Define the action buttons here
                            return `
                                <button class="btn btn-primary btn-sm view-button">View</button>
                            `;
                        },
                    },
                    // Add other columns as needed
                ],
                // Other configuration options go here
            });

            function goBack() {
                window.history.back();
            }

            const periodSelect = document.getElementById("period");
            const dateInputDaily = document.getElementById("dateInputDaily");
            const dateInputWeekly = document.getElementById("dateInputWeekly");
            const dateInputMonthly = document.getElementById("dateInputMonthly");
            const dateInputYearly = document.getElementById("dateInputYearly");

            // Function to update the table based on the selected filter
            function updateTable() {
                const selectedOption = periodSelect.value;
                let filterValue = "";

                // Get the filter value based on the selected option
                if (selectedOption === "daily") {
                    filterValue = document.getElementById("date").value;
                } else if (selectedOption === "weekly") {
                    filterValue = document.getElementById("week").value;
                } else if (selectedOption === "monthly") {
                    filterValue = document.getElementById("month").value;
                } else if (selectedOption === "yearly") {
                    filterValue = document.getElementById("yearly").value;
                }

                console.log("Selected Option:", selectedOption);
       

                axios.get('{{ route("filterLoanApplications") }}', {
                    params: {
                        selectedOption: selectedOption, // Include selectedOption
                        filterValue: filterValue, // Include filterValue
                    }
                })
                
                .then(function (response) {
                    const filteredData = response.data.filteredData;
                    const totalLoanApplications = response.data.totalLoanApplications;
                    const approvedLoanApplications = response.data.approvedLoanApplications;
                    const rejectedLoanApplications = response.data.rejectedLoanApplications;
                    const totalPrincipal = response.data.totalPrincipal;

                    document.getElementById("totalLoanApplications").textContent = totalLoanApplications;
                    document.getElementById("approvedLoanApplications").textContent = approvedLoanApplications;
                    document.getElementById("rejectedLoanApplications").textContent = rejectedLoanApplications;
                    document.getElementById("totalPrincipal").textContent = totalPrincipal;

                    console.log("DataTables Configuration:", $('#loanApplicationsTable').DataTable().settings()[0]);
                    console.log("Filtered Data:", filteredData);
                    console.log("totalLoanApplications Data:", totalLoanApplications);
                    console.log("approvedLoanApplications Data:", approvedLoanApplications);
                    console.log("rejectedLoanApplications Data:", rejectedLoanApplications);

                    
                    // Clear existing data in DataTables
                    table.clear();

                    table.rows.add(filteredData);

                    // Redraw DataTables
                    table.draw();

                })
                .catch(function (error) {
                    console.error(error);
                });
            }

            // Listen for changes in the select element
            periodSelect.addEventListener("change", function () {
                updateTable(); // Call the function to update the table when the select option changes
            });

            // Add event listeners to the date input elements
            document.getElementById("date").addEventListener("input", updateTable);
            document.getElementById("week").addEventListener("input", updateTable);
            document.getElementById("month").addEventListener("input", updateTable);
            document.getElementById("yearly").addEventListener("input", updateTable);

            // Initial call to update the table based on the default selected option (e.g., "Daily")
            updateTable();

            // Listen for changes in the select element
            periodSelect.addEventListener("change", function () {
                // Hide all date input divs
                dateInputDaily.style.display = "none";
                dateInputWeekly.style.display = "none";
                dateInputMonthly.style.display = "none";
                dateInputYearly.style.display = "none";

                // Show the selected date input div based on the chosen option
                const selectedOption = periodSelect.value;
                if (selectedOption === "daily") {
                    dateInputDaily.style.display = "flex";
                } else if (selectedOption === "weekly") {
                    dateInputWeekly.style.display = "flex";
                } else if (selectedOption === "monthly") {
                    dateInputMonthly.style.display = "flex";
                }
                else if (selectedOption === "yearly") {
                    dateInputYearly.style.display = "flex";
                }
            });
        </script>
@endsection

@endsection