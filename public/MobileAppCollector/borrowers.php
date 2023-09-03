<?php
// Include your database connection configuration
include 'connection.php';

// Create a response array
$response = array();

// Check if EmployeeID is set in the request
if (isset($_GET['EmployeeID'])) {
    $employeeID = $_GET['EmployeeID'];

    // Fetch data from the "borrowers" table for the specified EmployeeID
    $query = "SELECT * FROM borrowers WHERE EmployeeID = $employeeID";
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
        $response['message'] = 'Error fetching data from borrowers table';
        echo json_encode($response);
    }
} else {
    // Handle error
    $response['success'] = false;
    $response['message'] = 'EmployeeID is not provided in the request';
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
