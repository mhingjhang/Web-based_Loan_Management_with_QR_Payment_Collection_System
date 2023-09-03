<?php
include 'connection.php';

if (isset($_GET['LoanApplicationID'])) {
    $loanApplicationID = intval($_GET['LoanApplicationID']);

    $sql = "SELECT * FROM loan_applications WHERE LoanApplicationID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loanApplicationID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the loan information.
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $loanInfo = array(
            'Principal' => $row['Principal'],
            'Interest' => $row['Interest'],
            'TotalAmountDue' => $row['TotalAmountDue'],
            'DurationMonths' => $row['DurationMonths'],
            'DailyRepayment' => $row['DailyRepayment'],
            'ServiceFee' => $row['ServiceFee']
        );
        

        echo json_encode($loanInfo);
    } else {
        echo json_encode(array('error' => 'No loan information found.'));
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array('error' => 'LoanApplicationID parameter missing.'));
}
?>
