<?php
// Start or resume the session
session_start();

// Check if the doctor is logged in and their ID is available in the session
if (!isset($_SESSION["doctor_id"])) {
    // Redirect to the login page if the doctor is not logged in
    header("Location: doctor_login.php");
    exit;
}

// Get the doctor's ID from the session
$doctorId = $_SESSION["doctor_id"];

// Include database connection code
include("connection.php");

// Toggle the doctor's status between 0 and 1
$sqlDoctor = "SELECT status FROM doctors WHERE doctorid = '$doctorId'";
$resultDoctor = $conn->query($sqlDoctor);

if ($resultDoctor->num_rows == 1) {
    $rowDoctor = $resultDoctor->fetch_assoc();
    $currentStatus = $rowDoctor["status"];

    $newStatus = ($currentStatus == 0) ? 1 : 0;

    // Update the doctor's status in the database
    $updateSql = "UPDATE doctors SET status = '$newStatus' WHERE doctorid = '$doctorId'";
    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to the doctor's profile page
        header("Location: Doctors_profile.php");
        exit;
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    // Handle the case where doctor information is not found
    // You can redirect or show an error message
    echo "Doctor not found.";
    exit;
}

$conn->close();
?>
