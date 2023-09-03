<?php
include 'connection.php';

// Define response array
$response = array();

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all approval levels
    $sql = "SELECT * FROM approval_levels";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $approval_levels = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $approval_levels[] = $row;
        }
        
        $response['success'] = true;
        $response['message'] = 'Approval levels retrieved successfully';
        $response['data'] = $approval_levels;
    } else {
        $response['success'] = false;
        $response['message'] = 'Failed to retrieve approval levels';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new approval level
    
    // Get data from the request
    $approval_level = isset($_POST['approval_level']) ? $_POST['approval_level'] : '';
    
    // Validate input
    if (empty($approval_level)) {
        $response['success'] = false;
        $response['message'] = 'Approval level is required';
    } else {
        // Insert the new approval level into the database
        $sql = "INSERT INTO approval_levels (approval_level) VALUES ('$approval_level')";
        
        if (mysqli_query($conn, $sql)) {
            $response['success'] = true;
            $response['message'] = 'Approval level added successfully';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to add approval level';
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method';
}

// Close the database connection
mysqli_close($conn);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
