<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Treatment History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h1>Your Treatment History</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Department</th>
                    <th>Cabin Number</th>
                    <th>status</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection code (connection.php)
                include("connection.php");
                session_start();

                // Get patient ID from the session (assuming it's stored in $_SESSION['patient_id'])
                $patientId = $_SESSION['patientid'];

                // Fetch treatment data for the patient
                $sql = "SELECT t.*, d.dname, d.dept, d.cabinno FROM treatment t
                        INNER JOIN doctors d ON t.doctorid = d.doctorid
                        WHERE t.patientid = $patientId";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $doctorName = $row["dname"];
                        $department = $row["dept"];
                        $cabinNo = $row["cabinno"];
                        // $appointmentDate = $row["appointment_date"];
                        $feedback = $row["attend"];

                        echo "<tr>";
                        echo "<td>$doctorName</td>";
                        echo "<td>$department</td>";
                        echo "<td>$cabinNo</td>";
                        // echo "<td>$appointmentDate</td>";
                        echo "<td>";
                        if ($feedback == 1) {
                            echo "<a href='feedback.php?tid={$row["tid"]}' class='btn btn-primary'>Give Feedback</a>";
                        } else {
                            echo "After get treatment you can give feedback.";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No treatment history available.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
