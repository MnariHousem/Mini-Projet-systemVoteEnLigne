<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "voting_system"; // Correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables to hold error messages
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['username']; // Email as username
    $password = $_POST['password']; // Password

    // Check if the fields are empty
    if (empty($email) || empty($password)) {
        $_SESSION['errorMessage'] = "Please fill in both fields.";
        header("Location: login.php");
        exit();
    } else {
        // SQL query to check for matching credentials
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        $result = $conn->query($sql);

        // Check if the query returns a user
        if ($result->num_rows > 0) {
            // Start a session for the user
            $_SESSION['user'] = $email; // Store the email in session

            // Redirect to the voting interface (or your next page)
            header("Location: vote_interface.php");
            exit();
        } else {
            $_SESSION['errorMessage'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
