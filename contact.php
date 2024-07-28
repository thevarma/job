<?php
// Database connection
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO form_submissions (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Set parameters and execute
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $stmt->execute();

    // Close statement
    $stmt->close();

    header("Location: home.html");
}

// Close connection
$conn->close();
?>
