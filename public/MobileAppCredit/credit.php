<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userAccountId = $_GET["UserAccountID"];

    // Avoid SQL injection (for security)
    $userAccountId = mysqli_real_escape_string($conn, $userAccountId);

    // SQL query to fetch collector details based on UserAccountID
    $sql = "SELECT * FROM employees WHERE UserAccountID='$userAccountId'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch collector details
        $row = $result->fetch_assoc();
        $response = array(
            "EmployeeID" => $row["EmployeeID"],
            "UserAccountID" => $row["UserAccountID"],
            "FirstName" => $row["FirstName"],
            "MiddleName" => $row["MiddleName"],
            "LastName" => $row["LastName"],
            "Email" => $row["Email"],
            "ContactNumber" => $row["ContactNumber"],
            "ProfilePicture" => $row["ProfilePicture"]
            // Add other fields as needed
        );

        // Return JSON response
        echo json_encode($response);
    } else {
        // No collector details found
        $response = array("error" => "No collector details found for the given UserAccountID");
        echo json_encode($response);
    }
}
?>
