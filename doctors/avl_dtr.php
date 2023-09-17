<!-- available_doctors.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Available Doctors</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>Waiting Patients</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection code
                include("connection.php");

                // Fetch doctor data with status "avl" and waiting patients count from the database
                $sql = "SELECT dname, dept, dgender, doctorid FROM doctors WHERE status = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $doctorName = $row["dname"];
                        $department = $row["dept"];
                        $gender = $row["dgender"];
                        $doctorId = $row["doctorid"];

                        // Fetch and calculate the waiting patients count for each doctor
                        $waitingCount = 0; // You need to implement this logic

                        echo "<tr>";
                        echo "<td>$doctorName</td>";
                        echo "<td>$department</td>";
                        echo "<td>$gender</td>";
                        echo "<td>$waitingCount</td>";
                        echo "<td><a class='btn btn-primary' href='book_appointement.php?doctorid=$doctorId'>Book Appointment</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No available doctors.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
