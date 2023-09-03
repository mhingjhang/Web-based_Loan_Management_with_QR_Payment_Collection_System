<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']['name'])) {
        $userAccountID = intval($_POST['UserAccountID']); // Sanitize and cast to int
        $image = $_FILES['image']['name'];
        $tempImage = $_FILES['image']['tmp_name'];

        $allowedFormats = array("jpg", "jpeg", "png");
        $maxFileSize = 20 * 1024 * 1024;

        $fileExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedFormats)) {
            echo json_encode(array("error" => "Invalid file format. Allowed formats: JPG, JPEG, PNG"));
            exit;
        }

        if ($_FILES['image']['size'] > $maxFileSize) {
            echo json_encode(array("error" => "File size exceeds the allowed limit"));
            exit;
        }

        $uploadDirectory = "uploads/";
        $imagePath = $uploadDirectory . $image;
        if (move_uploaded_file($tempImage, $imagePath)) {
            $imageURL = image_url($imagePath);

            $updateQuery = "UPDATE user_accounts SET ProfilePicture = '$imageURL' WHERE UserAccountID = $userAccountID";

            if ($conn->query($updateQuery) === TRUE) {
                echo json_encode(array("success" => "Profile picture updated successfully"));
            } else {
                echo json_encode(array("error" => "Error updating profile picture: " . $conn->error));
                // Add this line to print the actual query for debugging
                echo json_encode(array("query" => $updateQuery));
            }
        } else {
            echo json_encode(array("error" => "Failed to move uploaded image"));
        }
    } else {
        echo json_encode(array("error" => "Image data not provided"));
    }
} else {
    echo json_encode(array("error" => "Invalid request method"));
}

$conn->close();

?>
s