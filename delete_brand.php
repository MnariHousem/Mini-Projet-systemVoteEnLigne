<?php
// delete_brand.php - Delete brand

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$brand_id = $_GET['id'];
$deleteBrandQuery = "DELETE FROM brands WHERE id = $brand_id";

if (mysqli_query($conn, $deleteBrandQuery)) {
    header("Location: admin_control.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
