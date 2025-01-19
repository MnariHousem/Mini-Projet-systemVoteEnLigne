<?php
// delete_category.php - Delete category and related brands

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$category_id = $_GET['id'];
$deleteBrandsQuery = "DELETE FROM brands WHERE category_id = $category_id";
mysqli_query($conn, $deleteBrandsQuery);
$deleteCategoryQuery = "DELETE FROM categories WHERE id = $category_id";

if (mysqli_query($conn, $deleteCategoryQuery)) {
    header("Location: admin_control.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
