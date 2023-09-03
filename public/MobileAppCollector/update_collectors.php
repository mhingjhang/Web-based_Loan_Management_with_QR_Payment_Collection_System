<?php

include 'connection.php';

if (isset($_POST["CollectorID"])) {
    $collectorID = $_POST["CollectorID"];
    $email = isset($_POST["Email"]) ? $_POST["Email"] : "";
    $contactNumber = isset($_POST["ContactNumber"]) ? $_POST["ContactNumber"] : "";
    $firstName = isset($_POST["FirstName"]) ? $_POST["FirstName"] : "";
    $middleName = isset($_POST["MiddleName"]) ? $_POST["MiddleName"] : "";
    $lastName = isset($_POST["LastName"]) ? $_POST["LastName"] : "";

    $sql = "UPDATE collectors SET 
                Email = '$email', 
                ContactNumber = '$contactNumber', 
                FirstName = '$firstName', 
                MiddleName = '$middleName', 
                LastName = '$lastName'
            WHERE CollectorID = $collectorID";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "User details updated successfully"));
    } else {
        echo json_encode(array("error" => "Error updating user details: " . $conn->error));
    }
} else {
    echo json_encode(array("error" => "Missing or invalid parameters"));
}

$conn->close();

?>
