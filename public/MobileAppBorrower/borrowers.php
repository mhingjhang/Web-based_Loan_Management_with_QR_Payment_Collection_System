<?php
include 'connection.php'; // Include your database connection file

// Check if the POST request contains the required fields
if (isset($_POST['FirstName'], $_POST['MiddleName'], $_POST['LastName'], $_POST['Gender'], $_POST['dateOfBirth'], $_POST['ContactNumber'], $_POST['Email'], $_POST['Street'], $_POST['Barangay'], $_POST['City_Municipality'], $_POST['Province'], $_POST['UserAccountID'], $_POST['ClientBusinessID'])) {

    // Sanitize and store the received data
    $firstName = $_POST['FirstName'];
    $middleName = $_POST['MiddleName'];
    $lastName = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $contactNumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    $street = $_POST['Street'];
    $barangay = $_POST['Barangay'];
    $cityMunicipality = $_POST['City_Municipality'];
    $province = $_POST['Province'];
    $userAccountId = $_POST['UserAccountID'];
    $clientBusinessID = $_POST['ClientBusinessID'];

    // Perform any necessary validation on the data

    // Insert the data into your database table
    $sql = "INSERT INTO borrowers (FirstName, MiddleName, LastName, Gender, DateOfBirth, ContactNumber, Email, Street, Barangay, City_Municipality, Province, UserAccountID, ClientBusinessID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Assuming you're using PDO for database operations
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$firstName, $middleName, $lastName, $gender, $dateOfBirth, $contactNumber, $email, $street, $barangay, $cityMunicipality, $province, $userAccountId, $clientBusinessID])) {
        // The data was successfully inserted
        echo json_encode(["message" => "Data inserted successfully"]);
    } else {
        // An error occurred while inserting data
        echo json_encode(["message" => "Failed to insert data"]);
    }
} else {
    // Required fields are missing in the POST request
    echo json_encode(["message" => "Missing required fields"]);
}
?>
