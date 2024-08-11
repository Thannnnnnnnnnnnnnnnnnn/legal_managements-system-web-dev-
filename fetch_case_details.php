<?php
include("connection.php");

if(isset($_POST['case_id'])) {
    $case_id = $_POST['case_id'];

    $query = "SELECT * FROM `table` WHERE `case_id` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $case_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $case_details = mysqli_fetch_assoc($result);

    if($case_details) {
        // Format case details into HTML
        $output = '<p><strong>Case Title:</strong> '.$case_details['case_title'].'</p>';
        $output .= '<p><strong>Case Description:</strong> '.$case_details['case_description'].'</p>';
        $output .= '<p><strong>Case Type:</strong> '.$case_details['case_type'].'</p>';
        $output .= '<p><strong>Time:</strong> '.$case_details['Time'].'</p>';
        $output .= '<p><strong>Date:</strong> '.$case_details['Date'].'</p>';

        echo $output;
    } else {
        echo "<p>No case details found</p>";
    }
} else {
    echo "<p>Case ID not provided</p>";
}
?>
