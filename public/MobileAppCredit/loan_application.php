<?php
include 'connection.php';

// Query to retrieve loan application data
$sql = "SELECT * FROM loan_applications";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row as JSON
    $loanApplications = array();

    while ($row = $result->fetch_assoc()) {
        $loanApplications[] = $row;
    }

    echo json_encode($loanApplications);
} else {
    echo "No loan applications found.";
}
?>
