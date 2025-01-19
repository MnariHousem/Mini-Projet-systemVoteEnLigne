<?php
// vote_action.php - Process user votes

// Old database connection method
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get vote data
$category_id = $_POST['category_id'];
$brand_id = $_POST['brand_id'];

// Insert or update the vote count in the results table
$query = "INSERT INTO results (category_id, brand_id, vote_count) 
          VALUES ('$category_id', '$brand_id', 1)
          ON DUPLICATE KEY UPDATE vote_count = vote_count + 1";
mysqli_query($conn, $query);

// Redirect to a confirmation page or the voting page
header('Location: thank_you.php');
?>
