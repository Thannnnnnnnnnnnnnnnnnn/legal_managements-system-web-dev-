<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $case_id = $_GET['id'];
    
    $case_id = mysqli_real_escape_string($connection, $case_id);
    
    // Update the `case_status` field in the database
    $query = "UPDATE `table` SET case_status = 'Rejected' WHERE case_id = '$case_id'";
    if (mysqli_query($connection, $query)) {
        // Redirect to the admin page after successful deletion
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
} else {
    // If case ID is not provided, redirect to the admin page
    header("Location: admin.php");
    exit();
}
?>
