<?php
// Include your database connection configuration
include 'connection.php';

// Create a response array
$response = array();

// Get the EmployeeID from the query parameters (if provided)
$employeeID = isset($_GET['EmployeeID']) ? intval($_GET['EmployeeID']) : null;

// Construct the SQL query with optional filtering by EmployeeID
$query = "SELECT * FROM loans";
if (!is_null($employeeID)) {
    $query .= " WHERE EmployeeID = $employeeID";
}

$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch data and add it to the response array
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle error
    $response['success'] = false;
    $response['message'] = 'Error fetching data from loans table';
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
