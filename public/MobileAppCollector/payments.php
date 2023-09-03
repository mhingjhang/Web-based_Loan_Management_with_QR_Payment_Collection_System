<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connection.php';

    $paymentDate = $_POST['PaymentDate'];
    $paymentAmount = $_POST['PaymentAmount'];
    $principalEarned = $_POST['PrincipalEarned'];
    $interestEarned = $_POST['InterestEarned'];
    $paymentMethod = $_POST['PaymentMethod'];
    $void = $_POST['Void'];
    $loanId = $_POST['LoanID'];
    $employeeId = $_POST['EmployeeID'];

    // Insert payment information into the database
    $sql = "INSERT INTO payments (PaymentDate, PaymentAmount, PrincipalEarned, InterestEarned, PaymentMethod, Void, LoanID, EmployeeID)
            VALUES ('$paymentDate', $paymentAmount, $principalEarned, $interestEarned, '$paymentMethod', '$void', $loanId, $employeeId)";

    if ($conn->query($sql) === TRUE) {
        // Payment successfully recorded
        $response = array("success" => true, "message" => "Payment recorded successfully");
        echo json_encode($response);
    } else {
        // Error occurred while recording payment
        $response = array("success" => false, "message" => "Failed to record payment");
        echo json_encode($response);
    }

    $conn->close();
} else {
    // Invalid request method
    $response = array("success" => false, "message" => "Invalid request method");
    echo json_encode($response);
}
?>
