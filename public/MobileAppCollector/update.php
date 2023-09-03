<?php

include 'connection.php';

if (
    isset($_POST['CollectorID']) &&
    isset($_POST['UserAccountID']) &&
    isset($_POST['FirstName']) &&
    isset($_POST['MiddleName']) &&
    isset($_POST['LastName']) &&
    isset($_POST['Email']) &&
    isset($_POST['UserName']) &&
    isset($_POST['Password']) &&
    isset($_POST['ProfilePicture']) &&
    isset($_POST['ContactNumber'])
) {
    // Sanitize and store POST data
    $collectorID = $_POST['CollectorID'];
    $userAccountID = $_POST['UserAccountID'];
    $firstName = $_POST['FirstName'];
    $middleName = $_POST['MiddleName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $userName = $_POST['UserName'];
    $password = $_POST['Password'];
    $profilePicture = $_POST['ProfilePicture'];
    $contactNumber = $_POST['ContactNumber'];

    // Update the collector's profile in the database
    // Modify this query to match your database schema
    $query = "UPDATE collectors SET
              FirstName = '$firstName',
              MiddleName = '$middleName',
              LastName = '$lastName',
              Email = '$email',
              ContactNumber = '$contactNumber'
              WHERE CollectorID = '$collectorID'";

    // Execute the query and check for success
    if (mysqli_query($connection, $query)) {
        // Update user account details (username and password)
        // Modify this query to match your database schema
        $userAccountQuery = "UPDATE user_accounts SET
                             UserName = '$userName',
                             Password = '$password'
                             WHERE UserAccountID = '$userAccountID'";

        // Execute the user account query
        if (mysqli_query($connection, $userAccountQuery)) {
            // Return a success response
            $response['success'] = true;
            $response['message'] = 'Profile and user account updated successfully';
        } else {
            // Return an error response for user account update
            $response['success'] = false;
            $response['message'] = 'Failed to update user account';
        }
    } else {
        // Return an error response for profile update
        $response['success'] = false;
        $response['message'] = 'Failed to update profile';
    }

} else {
    // Return an error response if required fields are not set
    $response['success'] = false;
    $response['message'] = 'Required fields are missing';
}

// Convert the response array to JSON format
echo json_encode($response);

?>
