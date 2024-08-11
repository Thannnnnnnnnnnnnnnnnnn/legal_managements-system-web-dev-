<?php
// Include your database connection
include("connection.php");

// Check if ID is provided
if(isset($_GET['id'])) {
    $caseId = $_GET['id'];
    // Query to fetch case details by ID
    $query = "SELECT * FROM `table` WHERE case_id = $caseId";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Build HTML content for displaying case details in the modal
        $html = "<p><strong>Case ID:</strong> {$row['case_id']}</p>";
        $html .= "<p><strong>Title:</strong> {$row['case_title']}</p>";
        $html .= "<p><strong>Description:</strong> {$row['case_description']}</p>";
        $html .= "<p><strong>Type:</strong> {$row['case_type']}</p>";
        $html .= "<p><strong>Time:</strong> {$row['Time']}</p>";
        $html .= "<p><strong>Date:</strong> {$row['Date']}</p>";
        echo $html;
    } else {
        echo "No case found with the provided ID.";
    }
} else {
    echo "No case ID provided.";
}
?>
