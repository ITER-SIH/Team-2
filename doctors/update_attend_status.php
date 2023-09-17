<?php
// Include database connection code
include("connection.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the treatment ID from the form
    $tid = $_POST["tid"];

    // Update the "attend" status in the treatment table
    $sql = "UPDATE treatment SET attend = 1 WHERE tid = '$tid'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the doctor's profile page after updating
        header("Location: Doctors_profile.php");
        exit();
    } else {
        echo "Error updating attend status: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
