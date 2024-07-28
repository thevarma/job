<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define database connection details
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "bharath";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO people (username, firstname, lastname, email, password, address, Aadhaar, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Set parameters and execute
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password
    $address = $_POST["address"];
    $aadhaar = $_POST["Aadhaar"];
    $dob = $_POST["dob"];

    $stmt->bind_param("ssssssss", $username, $firstname, $lastname, $email, $password, $address, $aadhaar, $dob);

    if ($stmt->execute()) {
        // Registration successful, redirect to home.html
        header("Location: home.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
