<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
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
                    <a class="nav-link" href="../contact.html">Contact</a>
                </li>
               
            </ul>
        </div>
    </nav>  
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 login-container">
                <h2 class="text-center mb-4">Doctor Login</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Include database connection code
                    include("connection.php");

                    // Get input data
                    $doctorId = $_POST["doctor_id"];
                    $password = $_POST["password"];

                    // Query to check doctor credentials
                    $sql = "SELECT doctorid, dname FROM doctors WHERE doctorid = '$doctorId' AND dpassword = '$password'";
                    $result = $conn->query($sql);
                    echo($password);

                    if ($result->num_rows == 1) {
                        // Doctor authenticated, set session and redirect to profile page
                        $row = $result->fetch_assoc();
                        session_start();
                        $_SESSION["doctor_id"] = $row["doctorid"];
                        $_SESSION["doctor_name"] = $row["dname"];
                        header("Location: Doctors_profile.php");
                        exit;
                    } else {
                        // Authentication failed
                        echo '<div class="alert alert-danger">Login failed. Please check your credentials.</div>';
                    }

                    $conn->close();
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="doctor_id">Doctor ID</label>
                        <input type="text" class="form-control" id="doctor_id" name="doctor_id" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
