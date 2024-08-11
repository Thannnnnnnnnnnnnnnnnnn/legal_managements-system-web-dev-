<?php
// Include your database connection
include("connection.php");

// Check if ID is provided
if(isset($_GET['id'])) {
    $caseId = $_GET['id'];
    // Prepare a parameterized query to fetch case details by ID
    $query = "SELECT * FROM `table` WHERE case_id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $caseId);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Build HTML content for the edit modal form
            $html = "<form id='edit-case-form'>";
            $html .= "<input type='hidden' name='edit-case-id' value='{$row['case_id']}'>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-title' class='form-label'>Title</label>";
            $html .= "<input type='text' class='form-control' id='edit-case-title' name='edit-case-title' value='{$row['case_title']}'>";
            $html .= "</div>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-description' class='form-label'>Description</label>";
            $html .= "<textarea class='form-control' id='edit-case-description' name='edit-case-description'>{$row['case_description']}</textarea>";
            $html .= "</div>";
            $html .= "<div class='mb-3'>";
            $html .= "<label for='edit-case-type' class='form-label'>Type</label>";
            $html .= "<input type='text' class='form-control' id='edit-case-type' name='edit-case-type' value='{$row['case_type']}'>";
            $html .= "</div>";
            // Add more fields if needed
            $html .= "<button type='submit' class='btn btn-primary'>Save Changes</button>  ";
            // Add close button
            $html .= "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
            
            // End of form
            $html .= "</form>";
            
            echo $html;
        } else {
            echo "No case found with the provided ID.";
        }
    } else {
        echo "Query execution failed.";
    }
} else {
    echo "No case ID provided.";
}
?>
