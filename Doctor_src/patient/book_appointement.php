<!-- book_appointment.php -->
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h1>Book Appointment</h1>
        <p>Select a doctor to book an appointment:</p>
        <ul class="list-group">
            <?php
            // Include database connection code
            include("connection.php");

            // Fetch and list available doctors
            $sql = "SELECT dname, doctorid FROM doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $doctorName = $row["dname"];
                    $doctorId = $row["doctorid"];

                    echo "<li class='list-group-item'>
                            $doctorName 
                            <a class='btn btn-primary float-right' href='book_appointment_process.php?doctorid=$doctorId&patientid=$patientId'>Book</a>
                          </li>";
                }
            } else {
                echo "<li class='list-group-item'>No doctors available.</li>";
            }

            $conn->close();
            ?>
        </ul>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
