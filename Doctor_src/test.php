<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease Prediction</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><img src="navbar.jpg" height="100px" width="200px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="help.html">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="grivence.html">grivences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><button type="button" class="btn btn-danger"> Logout </button> </a>
                </li>
               
            </ul>
        </div>
    </nav>  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Disease Prediction</h1>
                        
                        <!-- Create three symptom selection dropdowns -->
                        <form id="symptomForm">
                            <div class="form-group">
                                <label for="symptom1">Symptom 1:</label>
                                <select class="form-control" id="symptom1" name="symptom1">
                                    <!-- PHP code to populate the dropdown with symptoms from your CSV file -->
                                    <?php
                                        // Replace with the actual path to your CSV file
                                        $csvFilePath = 'symptoms_data.csv';

                                        // Read symptoms from the CSV file
                                        $symptoms = [];

                                        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
                                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                                // Skip the first row (header)
                                                if ($data[0] !== 'Symptom') {
                                                    $symptom = $data[0];
                                                    echo "<option value='$symptom'>$symptom</option>";
                                                }
                                            }
                                            fclose($handle);
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="symptom2">Symptom 2:</label>
                                <select class="form-control" id="symptom2" name="symptom2">
                                    <!-- PHP code to populate the dropdown with symptoms from your CSV file -->
                                    <?php
                                        // Replace with the actual path to your CSV file
                                        $csvFilePath = 'symptoms_data.csv';

                                        // Read symptoms from the CSV file
                                        $symptoms = [];

                                        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
                                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                                // Skip the first row (header)
                                                if ($data[0] !== 'Symptom') {
                                                    $symptom = $data[0];
                                                    echo "<option value='$symptom'>$symptom</option>";
                                                }
                                            }
                                            fclose($handle);
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="symptom3">Symptom 3:</label>
                                <select class="form-control" id="symptom3" name="symptom3">
                                    <!-- PHP code to populate the dropdown with symptoms from your CSV file -->
                                    <?php
                                        // Replace with the actual path to your CSV file
                                        $csvFilePath = 'symptoms_data.csv';

                                        // Read symptoms from the CSV file
                                        $symptoms = [];

                                        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
                                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                                // Skip the first row (header)
                                                if ($data[0] !== 'Symptom') {
                                                    $symptom = $data[0];
                                                    echo "<option value='$symptom'>$symptom</option>";
                                                }
                                            }
                                            fclose($handle);
                                        }
                                    ?>
                                </select>
                            </div>

                            <!-- Add a button to submit the selected symptoms -->
                            <button type="button" class="btn btn-primary btn-block" onclick="predictDisease()">Predict Disease</button>
                        </form>

                        <!-- Display the prediction result here -->
                        <div id="predictionResult" class="mt-3 text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap and jQuery JS links at the end of the body for proper loading -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function predictDisease() {
            // Get selected symptoms from dropdowns
            var symptom1 = document.getElementById("symptom1").value;
            var symptom2 = document.getElementById("symptom2").value;
            var symptom3 = document.getElementById("symptom3").value;

            // Prepare the data to send to your Flask API as JSON
            var inputData = [
                { "Symptom": symptom1 },
                { "Symptom": symptom2 },
                { "Symptom": symptom3 }
            ];

            // Send a POST request to your Flask API
            fetch('http://127.0.0.1:5000/predict_disease', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(inputData),
            })
            .then(response => response.json())
            .then(data => {
                // Display the predicted disease
                document.getElementById("predictionResult").innerHTML = "Predicted Disease: " + data.predicted_disease;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("predictionResult").innerHTML = "An error occurred.";
            });
        }
    </script>
</body>
</html>
