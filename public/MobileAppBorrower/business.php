<?php
// Include the database connection
include 'connection.php';

// Get form data
$businessName = $_POST['BusinessName'];
$averageDailyIncome = $_POST['AverageDailyIncome'];
$typeOfBusiness = $_POST['TypeOfBusiness'];
$street = $_POST['Street'];
$barangay = $_POST['Barangay'];
$cityMunicipality = $_POST['City_Municipality'];
$province = $_POST['Province'];

// SQL query to insert data
$sql = "INSERT INTO businesses (BusinessName, AverageDailyIncome, TypeOfBusiness, Street, Barangay, City_Municipality, Province)
        VALUES ('$businessName', '$averageDailyIncome', '$typeOfBusiness', '$street', '$barangay', '$cityMunicipality', '$province')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
