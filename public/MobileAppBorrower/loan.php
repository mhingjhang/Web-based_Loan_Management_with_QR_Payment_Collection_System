<?php
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $principal = $_POST['Principal'];
    $durationDays = $_POST['DurationDays'];
    $durationMonths = $_POST['DurationMonths'];
    $interest = $_POST['Interest'];
    $interestRate = $_POST['InterestRate'];
    $totalAmountDue = $_POST['TotalAmountDue'];
    $dailyRepayment = $_POST['DailyRepayment'];
    $serviceFee = $_POST['ServiceFee'];
    

    // Insert data into the table (you should replace 'your_table_name' with your actual table name)
    $insertQuery = "INSERT INTO loan_applications (Principal, DurationDays, DurationMonths, Interest, InterestRate, TotalAmountDue, DailyRepayment, ServiceFee) VALUES ('$principal', '$durationDays', '$durationMonths', '$interest', '$interestRate', '$totalAmountDue', '$dailyRepayment', '$serviceFee')";
    
    if (mysqli_query($conn, $insertQuery)) {
        // Data insertion successful, return success response
        $response = array("status" => "success", "message" => "Data inserted successfully");
        echo json_encode($response);
    } else {
        // Data insertion failed, return error response
        $response = array("status" => "error", "message" => "Data insertion failed");
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
