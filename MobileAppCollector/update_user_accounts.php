<?php

include 'connection.php';

if (isset($_POST["UserAccountID"])) {
    $userAccountID = $_POST["UserAccountID"];
    $userName = isset($_POST["UserName"]) ? $_POST["UserName"] : "";
    $password = isset($_POST["Password"]) ? $_POST["Password"] : "";

    // Handle file upload if ProfilePicture is provided
    $profilePicturePath = '';
    if (isset($_FILES["ProfilePicture"]["tmp_name"])) {
        $targetDirectory = "uploads/"; // Specify your target directory
        $profilePicturePath = $targetDirectory . basename($_FILES["ProfilePicture"]["name"]);
        move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], $profilePicturePath);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE user_accounts SET 
                UserName = ?, 
                Password = ?, 
                ProfilePicture = ?
            WHERE UserAccountID = ?");
    $stmt->bind_param("sssi", $userName, $password, $profilePicturePath, $userAccountID);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "User details updated successfully"));
    } else {
        echo json_encode(array("error" => "Error updating user details: " . $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "Missing or invalid parameters"));
}

$conn->close();

?>
