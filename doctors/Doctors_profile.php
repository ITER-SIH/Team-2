<!-- doctor_profile.php -->
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

// Initialize the $status variable
$status = 0;

// Query to fetch doctor information
$sqlDoctor = "SELECT dname, dept, dgender, cabinno, status FROM doctors WHERE doctorid = '$doctorId'";
$resultDoctor = $conn->query($sqlDoctor);

// Fetch doctor information
if ($resultDoctor->num_rows == 1) {
    $rowDoctor = $resultDoctor->fetch_assoc();
    $doctorName = $rowDoctor["dname"];
    $department = $rowDoctor["dept"];
    $gender = $rowDoctor["dgender"];
    $cabNo = $rowDoctor["cabinno"];
    $status = $rowDoctor["status"];
} else {
    // Handle the case where doctor information is not found
    // You can redirect or show an error message
    echo "Doctor not found.";
    exit;
}

// Query to fetch appointments for the doctor
$sqlAppointments = "SELECT tid, patientid FROM treatment WHERE doctorid = '$doctorId'";
$resultAppointments = $conn->query($sqlAppointments);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Doctor Profile</title>
    <!-- Add your CSS styling here -->
</head>
<body>
    <!-- Include your navigation bar here -->
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
                <li class="nav-item active">
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
        <!-- Display doctor information here -->
        <h1>Welcome, <?php echo $doctorName; ?></h1>
        <p><strong>Department:</strong> <?php echo $department; ?></p>
        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        <p><strong>Cabin Number:</strong> <?php echo $cabNo; ?></p>
        <p><strong>Status:</strong> <?php if ($status == 0) { echo "Inactive"; } else { echo "Active"; } ?></p> <!-- Display doctor's status -->
        <form method="post" action="doctor_status_update.php">
            <button type="submit" name="changeStatus" class="btn btn-primary">
                <?php if ($status == 0) { echo "Activate"; } else { echo "Deactivate"; } ?> Status
            </button>
        </form>
    </div>

    <div class="container mt-5">
    <?php
// ... (previous code)

// Query to fetch doctor's appointments with patient name
$sqlAppointments = "SELECT t.tid, t.patientid, t.doctorid, t.attend, p.pname FROM treatment t
                   JOIN patients p ON t.patientid = p.patientid
                   WHERE t.doctorid = '$doctorId'";
$resultAppointments = $conn->query($sqlAppointments);
?>

<!-- Display doctor's appointments with patient name and update button -->
<div class="container mt-5">
    <h2>Appointments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Treatment ID</th>
                <th>Patient Name</th>
                <th>Doctor ID</th>
                <th>Attend</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultAppointments->num_rows > 0) {
                while ($rowAppointment = $resultAppointments->fetch_assoc()) {
                    $appointmentId = $rowAppointment["tid"];
                    $patientName = $rowAppointment["pname"];
                    $doctorId = $rowAppointment["doctorid"];
                    $attendStatus = $rowAppointment["attend"];

                    echo "<tr>";
                    echo "<td>$appointmentId</td>";
                    echo "<td>$patientName</td>";
                    echo "<td>$doctorId</td>";
                    echo "<td>$attendStatus</td>";
                    echo "<td>";
                    if ($attendStatus == 0) {
                        echo "<form method='post' action='update_attend_status.php'>";
                        echo "<input type='hidden' name='tid' value='$appointmentId'>";
                        echo "<button type='submit' class='btn btn-primary'>Attend</button>";
                        echo "</form>";
                    } else {
                        echo "Attended";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No appointments available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXs

</body>
</html>
