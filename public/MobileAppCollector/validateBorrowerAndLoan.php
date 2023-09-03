<?php
include 'connection.php';


try {
    $borrowerId = $_GET['BorrowerID'];
    $loanId = $_GET['LoanID'];

    $response = array(
        'exists' => false,
        'data' => null
    );

    if (!isset($borrowerId) || !isset($loanId)) {
        throw new Exception("Missing BorrowersID or LoanID in the URL parameters.");
    }

   $query = $pdo->prepare("SELECT b.FirstName AS BorrowerFirstName, b.MiddleName AS BorrowerMiddleName, b.LastName AS BorrowerLastName, b.BorrowerPhoto AS BorrowerPhoto,
                        l.DailyRepayment
                        FROM borrowers b
                        LEFT JOIN loans l ON b.BorrowerID = l.BorrowerID
                        WHERE b.BorrowerID = ? AND l.BorrowerID = ?");

    
    if (!$query) {
        throw new Exception("Error preparing SQL query: " . $pdo->errorInfo()[2]);
    }

    $query->execute([$borrowerId, $loanId]);

    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $response['exists'] = true;
        $response['data'] = $row;
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($response);
?>
