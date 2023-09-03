<?php
 include 'connection.php';
 
if (isset($_POST['ApprovalLevelID'], $_POST['LoanApplicationID'], $_POST['created_at'], $_POST['updated_at'])) {
    // Sanitize and store the POST data
    $approvalLevelID = intval($_POST['ApprovalLevelID']);
    $loanApplicationID = intval($_POST['LoanApplicationID']);
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['updated_at'];

    // Insert the new approval record into your database
    // Example SQL query (replace with your actual table name and column names):
    $sql = "INSERT INTO approvals (ApprovalLevelID, LoanApplicationID, created_at, updated_at)
            VALUES ($approvalLevelID, $loanApplicationID, '$created_at', '$updated_at')";

    // Execute the SQL query
    // Example: $result = mysqli_query($conn, $sql);

    if ($result) {
        // Approval record inserted successfully
        http_response_code(201); // Created
        echo json_encode(array("message" => "Approval created successfully."));
    } else {
        // Error inserting approval record
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Unable to create approval."));
    }
} else {
    // Missing POST parameters
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Missing required parameters."));
}
?>
