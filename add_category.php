<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

// Handle form submission (adding a new category)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    // Save category to the database
    $db = new mysqli('localhost', 'root', '', 'voting_system');
    $stmt = $db->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $category_name);
    $stmt->execute();

    $_SESSION['message'] = "Category '$category_name' added successfully!";
    header("Location: add_category.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Panel</title>
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

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        <h1>Add New Category</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div style='color: green;'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>

        <form action="add_category.php" method="POST">
            <input type="text" name="category_name" placeholder="Category Name" required>
            <button type="submit">Add Category</button>
        </form>

        <a href="admin_control.php">Back to Admin Dashboard</a>
    </div>
</body>
</html>
