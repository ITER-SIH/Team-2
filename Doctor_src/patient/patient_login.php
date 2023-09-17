<?php
// Include database connection code
include("connection.php");

// Initialize session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform a query to check if the email and password match a patient in the database
    $sql = "SELECT * FROM patients WHERE pemail = '$email' AND ppassword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, store patient ID in session
        $row = $result->fetch_assoc();
        $_SESSION["patientid"] = $row["patientid"];
        
        echo "hello";
        // Redirect to the patient profile page
        header("Location: patient_profile.php");
        exit();
    } else {
        // Login failed, display an error message or redirect back to the login page with an error message
        // echo $password;
        echo "Login failed. Please check your email and password.";
        // You can also use header("Location: patient_login.html?error=1"); to redirect with an error message
    }
}

// Close the database connection
$conn->close();
?>
