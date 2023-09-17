<?php
// Start or resume the session
session_start();

// Check if the patient is logged in and their ID is available in the session
if (!isset($_SESSION["patientid"])) {
    // Redirect to the login page if the patient is not logged in
    header("Location: login.php");
    exit;
}

// Get the patient's ID from the session
$patientId = $_SESSION["patientid"];

// Check if the doctor ID and patient ID are provided in the URL
if (isset($_GET["doctorid"])) {
    $doctorId = $_GET["doctorid"];
} else {
    // Redirect to the book appointment page if the doctor ID is not provided
    header("Location: book_appointment.php");
    exit;
}

// Include database connection code
include("connection.php");

// Prepare and execute an SQL query to insert the appointment
$sql = "INSERT INTO treatment (doctorid, patientid, attend) VALUES (?, ?, 0)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $doctorId, $patientId);
    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header("Location: patient_profile.php");
        exit;
    } else {
        // Handle the case where the appointment insertion fails
        echo "Error: " . $stmt->error;
    }
} else {
    // Handle the case where the SQL statement preparation fails
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
