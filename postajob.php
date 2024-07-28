<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bharath";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get job details from form
    $job_type = $_POST["job-type"];
    $company = $_POST["company"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $posted_on = $_POST["posted-on"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO jobs (job_type, company, location, description, posted_on) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $job_type, $company, $location, $description, $posted_on);

    // Execute statement
    if ($stmt->execute()) {
        // Job posted successfully
        header("Location: jobs.html");
    } else {
        
        header("Location: jobs.html");
        echo "Error posting job: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
