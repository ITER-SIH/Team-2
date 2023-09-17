<?php
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['patientid'])) {
    header("Location: plogin.php"); // Redirect to login page if not logged in
    exit();
}

// Include your database connection code
include("connection.php");

// Fetch patient information from the database
$patient_id = $_SESSION['patientid'];
$query = "SELECT * FROM patients WHERE patientid = $patient_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patientName = $row['pname'];
    $patientEmail = $row['pemail'];
    $patientGender = $row['gender'];
    $patientCity = $row['pcity'];
    // Add more fields as needed
} else {
    // Handle the case where no patient information is found
    $patientName = "N/A";
    $patientEmail = "N/A";
    $patientGender = "N/A";
    $patientCity = "N/A";
    // Add more fields as needed
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <!-- Add your Bootstrap and CSS links here for 3D styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add any additional CSS styles for 3D styling here -->
    <style>
        /* Add your custom styling for the profile page here */
        .profile-container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px #ccc;
        }
        .center-button {
            text-align: center;
        }
        .centered-button {
            text-align: center;
            margin-top: 20px;
        }

        .red-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .red-button:hover {
            background-color: darkred;
        }

    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php"><img src="../navbar.jpg" height="100px" width="200px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../help.html">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../grivence.html">grivences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><button type="button" class="btn btn-danger"> Logout </button> </a>
                </li>
                
               
            </ul>
        </div>
    </nav>  
    
    <div class="container mt-5">
        <div class="profile-container">
            <h1>Patient Profile</h1>
            <div class="form-group">
                <label for="patientName">Name:</label>
                <input type="text" class="form-control" id="patientName" value="<?php echo $patientName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="patientEmail">Email:</label>
                <input type="email" class="form-control" id="patientEmail" value="<?php echo $patientEmail; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="patientGender">Gender:</label>
                <input type="text" class="form-control" id="patientGender" value="<?php echo $patientGender; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="patientCity">City:</label>
                <input type="text" class="form-control" id="patientCity" value="<?php echo $patientCity; ?>" readonly>
            </div>
            <!-- Add more fields as needed -->
            <div class="center-button">
                <a href="avl_dtr.php" class="btn btn-primary btn-lg">Search Doctors</a>
            </div>
            <div class="centered-button">
                <a href="your_app.php" class="btn red-button">Your Appointment</a>
            </div>
            <div class="card user-card">
            <h3>KNOW YOUR DISEASE </h3>
            <a href="../test.php"> <button type="button" class="btn btn-warning"> Expected Disease Founder </button></a>
            
        </div>
        </div>
    </div>

    <!-- Add your Bootstrap and JS links here -->

</body>
</html>
