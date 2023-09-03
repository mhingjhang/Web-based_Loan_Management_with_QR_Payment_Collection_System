<?php

include 'connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $approvalLevelID = $_POST['ApprovalLevelID'];
    $loanApplicationID = $_POST['LoanApplicationID'];
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['updated_at'];

    // Prepare and execute the SQL query to insert the approval record
    $sql = "INSERT INTO approvals (ApprovalLevelID, LoanApplicationID, created_at, updated_at) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $approvalLevelID, $loanApplicationID, $created_at, $updated_at);

    if ($stmt->execute()) {
        // Successfully inserted the approval record
        $response = array("status" => "success", "message" => "Approval record created successfully.");
        echo json_encode($response);
    } else {
        // Error occurred while inserting the record
        $response = array("status" => "error", "message" => "Failed to create approval record.");
        echo json_encode($response);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    $response = array("status" => "error", "message" => "Invalid request method.");
    echo json_encode($response);
}
?>
