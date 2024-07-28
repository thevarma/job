<?php
session_start();
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "bharath";
$useremail = $_POST['email'];
$userpass = $_POST['password'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection to the database failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM people WHERE email = ?");
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();

$loginSuccessful = false;

while ($row = $result->fetch_assoc()) {
    $hashed_password = $row['password'];

    if (password_verify($userpass, $hashed_password)) {
        $loginSuccessful = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        break;
    }
}

if ($loginSuccessful) {
    header("Location: jobs.html");
    exit();
} else {
    header("Location: home.html");
    exit();
}

$stmt->close();
$conn->close();
?>