<?php
include 'connection.php';

$firstName = $_POST['FirstName'];
$middleName = $_POST['MiddleName'];
$lastName = $_POST['LastName'];
$gender = $_POST['Gender'];

// Parse the received formatted date to YYYY-MM-DD format
$dateOfBirth = DateTime::createFromFormat('m/d/Y', $_POST['DateOfBirth']);

$contactNumber = $_POST['ContactNumber'];
$email = $_POST['Email'];
$street = $_POST['Street'];
$barangay = $_POST['Barangay'];
$cityMunicipality = $_POST['City_Municipality'];
$province = $_POST['Province'];

$sql = "INSERT INTO borrowers (FirstName, MiddleName, LastName, Gender, DateOfBirth, ContactNumber, Email, Street, Barangay, City_Municipality, Province) 
        VALUES ('$firstName', '$middleName', '$lastName', '$gender', '$dateOfBirth', '$contactNumber', '$email', '$street', '$barangay', '$cityMunicipality', '$province')";

if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Borrower data inserted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error inserting borrower data: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
