<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "admin";
$database = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if sign-up or sign-in form is submitted
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Sign-up form submitted
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user into database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Sign-up successful, redirect to success page or perform desired action
        header("Location: success.html");
    } else {
        // Sign-up failed, redirect back to login page with error message
        header("Location: login.html?error=signup");
    }
} elseif (isset($_POST['signinUsername']) && isset($_POST['signinPassword'])) {
    // Sign-in form submitted
    $username = $_POST['signinUsername'];
    $password = $_POST['signinPassword'];

    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, redirect to success page or perform desired action
        header("Location: success.html");
    } else {
        // User not found, redirect back to login page with error message
        header("Location: login.html?error=signin");
    }
}

$conn->close();
?>
