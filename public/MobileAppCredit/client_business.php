<?php
include 'connection.php';

if (isset($_GET['ClientBusinessID'])) {
    $clientBusinessID = intval($_GET['ClientBusinessID']);

     $sql = "SELECT * FROM client_businesses WHERE ClientBusinessID = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $clientBusinessID);
     $stmt->execute();
     $result = $stmt->get_result();

    // Fetch the business information.
     if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $businessInfo = array(
             'BusinessName' => $row['BusinessName'],
             'AverageDailyIncome' => $row['AverageDailyIncome'],
             'TypeOfBusiness' => $row['TypeOfBusiness'],
             'Street' => $row['Street'],
             'City_Municipality' => $row['City_Municipality'],
             'Province' => $row['Province']
         );

         echo json_encode($businessInfo);
     } else {
         echo json_encode(array('error' => 'No business information found.'));
     }

     $stmt->close();
     $conn->close();
} else {
    echo json_encode(array('error' => 'ClientBusinessID parameter missing.'));
}
?>
