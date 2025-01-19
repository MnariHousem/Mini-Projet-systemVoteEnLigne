<?php
// get_brands.php - Fetch brands for a given category ID

// Old database connection method
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the category ID from the request
$category_id = $_GET['category_id'];

if ($category_id) {
    // Fetch brands for the selected category
    $query = "SELECT * FROM brands WHERE category_id = $category_id";
    $result = mysqli_query($conn, $query);

    $brands = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $brands[] = $row;
    }

    // Return the brands as JSON
    echo json_encode($brands);
} else {
    echo json_encode([]);
}
?>
