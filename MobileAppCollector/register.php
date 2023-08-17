<?php
include 'connection.php';

if(isset($_POST['insert'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profilePicture = $_FILES['profile_picture']['name'];

    // File upload path
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);

    // Move uploaded image to target directory
    if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)){
        // Insert data into the table
        $query = "INSERT INTO user_accounts (UserName, Password, ProfilePicture, Status)
                    VALUES ('$username', '$password', '$profilePicture', 'Active')";

        // Execute the query
        if(mysqli_query($conn, $query)){
            echo "Data inserted successfully.";
        } else{
            echo "Error: " . mysqli_error($conn);
        }
    } else{
        echo "Error uploading the image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Form</title>
</head>
<body>
    <h2>Upload Form</h2>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        
        <label for="profile_picture">Image:</label>
        <input type="file" name="profile_picture" id="image_pic" required><br><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" name="insert" value="Submit">
    </form>
</body>
</html>
