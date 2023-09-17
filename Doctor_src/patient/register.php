<!-- register.php -->
<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["pname"];
    $ppassword = $_POST["ppassword"];
    $paddress = $_POST["paddress"];
    $page = $_POST["page"];
    $gender = $_POST["gender"];
    $pcity = $_POST["pcity"];
    $pemail = $_POST["pemail"];

    $insert_query = "INSERT INTO patients (pname, ppassword, paddress, page, gender, pcity, pemail)
                     VALUES ('$pname', '$ppassword', '$paddress', $page, '$gender', '$pcity', '$pemail')";

    if ($conn->query($insert_query) === TRUE) {
        // echo "Registration successful!";
        header("Location: ../index.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
