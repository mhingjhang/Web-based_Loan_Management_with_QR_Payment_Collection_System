<?php
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $username = $_POST['UserName'];
    $password = $_POST['Password'];

    // Check if the username already exists using a prepared statement
    $checkQuery = "SELECT * FROM user_accounts WHERE UserName = ?";
    $checkStatement = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStatement, "s", $username);
    mysqli_stmt_execute($checkStatement);
    $checkResult = mysqli_stmt_get_result($checkStatement);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username already exists, return error response
        $response = array("status" => "error", "message" => "Username already exists");
        echo json_encode($response);
    } else {
        // Insert data into the table using a prepared statement
        $insertQuery = "INSERT INTO user_accounts (UserName, Password) VALUES (?, ?)";
        $insertStatement = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStatement, "ss", $username, $password);

        if (mysqli_stmt_execute($insertStatement)) {
            // Registration successful, return success response
            $response = array("status" => "success", "message" => "Registration successful");
            echo json_encode($response);
        } else {
            // Registration failed, return error response
            $response = array("status" => "error", "message" => "Registration failed");
            echo json_encode($response);
        }
    }

    // Close the prepared statements
    mysqli_stmt_close($checkStatement);
    mysqli_stmt_close($insertStatement);
} else {
    // Invalid request method
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
