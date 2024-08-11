<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['edit-case-id']) && isset($_POST['edit-case-title']) && isset($_POST['edit-case-description']) && isset($_POST['edit-case-type'])) {
        // Sanitize the input data to prevent SQL injection
        $caseId = mysqli_real_escape_string($connection, $_POST['edit-case-id']);
        $title = mysqli_real_escape_string($connection, $_POST['edit-case-title']);
        $description = mysqli_real_escape_string($connection, $_POST['edit-case-description']);
        $type = mysqli_real_escape_string($connection, $_POST['edit-case-type']);

        // Update the record in the database
        $query = "UPDATE `table` SET `case_title` = '$title', `case_description` = '$description', `case_type` = '$type' WHERE `case_id` = '$caseId'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Return a success response
            echo json_encode(array("success" => true));
        } else {
            // Return an error response
            echo json_encode(array("success" => false, "error" => "Failed to update record"));
        }
    } else {
        // Return an error response if required fields are missing
        echo json_encode(array("success" => false, "error" => "Missing required fields"));
    }
} else {
    // Return an error response if the request method is not POST
    echo json_encode(array("success" => false, "error" => "Invalid request method"));
}
?>
