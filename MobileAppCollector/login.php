<?php
include 'connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];

    // Avoid SQL injection (for security)
    $UserName = mysqli_real_escape_string($conn, $UserName);
    $Password = mysqli_real_escape_string($conn, $Password);


    // SQL query to check if the username and hashed password match
    $sql = "SELECT * FROM user_accounts WHERE UserName='$UserName' AND Password='$Password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        $response = array(
            "UserAccountID" => $row["UserAccountID"],
            "UserName" => $row["UserName"],
            "Password" => $row["Password"],
            "ProfilePicture" => $row["ProfilePicture"],

        );

        // Return JSON response
        echo json_encode($response);
    } else {
        // Login failed
        $response = array("error" => "Invalid username or password");
        echo json_encode($response);
    }
}

?>
