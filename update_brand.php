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



// Fetch brand details and categories for the dropdown
if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];
    $brand_query = "SELECT * FROM brands WHERE id = $brand_id";
    $brand_result = mysqli_query($conn, $brand_query);
    $brand = mysqli_fetch_assoc($brand_result);

    $categories_query = "SELECT * FROM categories";
    $categories_result = mysqli_query($conn, $categories_query);
}

// Handle brand update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['brand_name'];
    $new_category = $_POST['category_id'];
    $update_query = "UPDATE brands SET name = '$new_name', category_id = $new_category WHERE id = $brand_id";
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
    <title>Update Brand</title>
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
        input, select, button {
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
        <h1>Update Brand</h1>
        <form method="POST">
            <label for="brand_name">Brand Name</label>
            <input type="text" name="brand_name" id="brand_name" value="<?= $brand['name']; ?>" required>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <option value="<?= $category['id']; ?>" <?= $brand['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                        <?= $category['name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
