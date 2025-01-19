<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$db = new mysqli('localhost', 'root', '', 'voting_system');

// Fetch categories from the database
$categories_result = $db->query("SELECT id, name FROM categories");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}

// Handle form submission (adding a brand)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category'];
    $brand_name = $_POST['brand'];

    // Insert brand into the database
    $stmt = $db->prepare("INSERT INTO brands (name, category_id) VALUES (?, ?)");
    $stmt->bind_param("si", $brand_name, $category_id);
    $stmt->execute();

    $_SESSION['message'] = "Brand '$brand_name' added successfully to the category!";
    header("Location: add_brand.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand - Admin Panel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff6f61, #f4f4f9);
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .admin-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            color: #ff6f61;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 12px;
            width: 100%;
            background-color: #ff6f61;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e05550;
        }

        a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #ff6f61;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Add New Brand</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div style='color: green;'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>

        <form action="add_brand.php" method="POST">
            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="">Select a Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="brand">Brand Name</label>
            <input type="text" name="brand" id="brand" placeholder="Brand Name" required>

            <button type="submit">Add Brand</button>
        </form>

        <a href="admin_control.php">Back to Admin Dashboard</a>
    </div>
</body>
</html>
