<?php
// Include your database connection
include("connection.php");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields and sanitize inputs
    if (isset($_POST['edit-case-id'], $_POST['edit-case-title'], $_POST['edit-case-description'], $_POST['edit-case-type'])) {
        $caseId = $_POST['edit-case-id'];
        $title = mysqli_real_escape_string($connection, $_POST['edit-case-title']);
        $description = mysqli_real_escape_string($connection, $_POST['edit-case-description']);
        $type = mysqli_real_escape_string($connection, $_POST['edit-case-type']);

        // Prepare and bind parameters to the statement
        $query = "UPDATE `table` SET case_title = ?, case_description = ?, case_type = ? WHERE case_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $type, $caseId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Return success response
            echo json_encode(array("success" => true));
        } else {
            // Return error response
            echo json_encode(array("success" => false, "error" => "Failed to update record."));
        }
        mysqli_stmt_close($stmt);
    } else {
        // Return error response if form fields are missing
        echo json_encode(array("success" => false, "error" => "One or more form fields are missing."));
    }
} else {
    // Return error response if form data is not submitted
    echo json_encode(array("success" => false, "error" => "Form data not submitted."));
}
?>
