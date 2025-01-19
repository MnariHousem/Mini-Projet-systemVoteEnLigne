<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    
}



// Fetch category details
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $category_query = "SELECT * FROM categories WHERE id = $category_id";
    $category_result = mysqli_query($conn, $category_query);
    $category = mysqli_fetch_assoc($category_result);
}

// Handle category update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['category_name'];
    $update_query = "UPDATE categories SET name = '$new_name' WHERE id = $category_id";
    mysqli_query($conn, $update_query);
    header('Location: admin_control.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f9;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Category</h1>
        <form method="POST">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" value="<?= $category['name']; ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
