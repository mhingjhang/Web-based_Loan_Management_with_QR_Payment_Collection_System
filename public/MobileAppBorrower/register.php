<?php
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $firstName = $_POST['FirstName'];
    $middleName = $_POST['MiddleName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $number = $_POST['Number'];
    $username = $_POST['UserName'];
    $password = $_POST['Password'];

    // Check if the username already exists
    $checkQuery = "SELECT * FROM user_accounts WHERE UserName = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username already exists, return error response
        $response = array("status" => "error", "message" => "Username already exists");
        echo json_encode($response);
    } else {
        // Insert data into the table
        $insertQuery = "INSERT INTO user_accounts (FirstName, MiddleName, LastName, Email, Number, UserName, Password) VALUES ('$firstName', '$middleName', '$lastName', '$email', '$number', '$username', '$password')";
        if (mysqli_query($conn, $insertQuery)) {
            // Registration successful, return success response
            $response = array("status" => "success", "message" => "Registration successful");
            echo json_encode($response);
        } else {
            // Registration failed, return error response
            $response = array("status" => "error", "message" => "Registration failed");
            echo json_encode($response);
        }
    }
} else {
    // Invalid request method
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
