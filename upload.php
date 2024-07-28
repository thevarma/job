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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Check if file upload is successful
    if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileType = $_FILES["file"]["type"];
        
        // Define the upload directory
        $uploadDirectory = "uploads/";

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($fileTmpName, $uploadDirectory . $fileName)) {
            // File upload successful, insert file details into the database
            $sql = "INSERT INTO files (file_name, file_type, file_size) VALUES ('$fileName', '$fileType', '$fileSize')";
            
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Error uploading file: " . $_FILES["file"]["error"];
    }
}

$conn->close();
?>
