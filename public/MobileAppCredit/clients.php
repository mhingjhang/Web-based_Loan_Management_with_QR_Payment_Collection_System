<?php
// Database configuration
include 'connection.php'; // Assuming this file contains database connection setup

// Query to fetch clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

$clients = array();

if ($result->num_rows > 0) {
    // Fetch each row and store in the $clients array
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
}

// Close connection
$conn->close();

// Return JSON response with clients data
header('Content-Type: application/json');
echo json_encode($clients);
?>
