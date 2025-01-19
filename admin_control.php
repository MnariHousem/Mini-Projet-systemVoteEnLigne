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



// Fetch categories
$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

// Fetch brands with category name
$brands_query = "SELECT brands.id AS brand_id, brands.name AS brand_name, categories.name AS category_name 
                 FROM brands 
                 JOIN categories ON brands.category_id = categories.id";
$brands_result = mysqli_query($conn, $brands_query);

// Fetch voting results
$results_query = "SELECT brands.name AS brand_name, categories.name AS category_name, COUNT(results.id) AS vote_count
                  FROM results
                  JOIN brands ON results.brand_id = brands.id
                  JOIN categories ON brands.category_id = categories.id
                  GROUP BY brands.id, categories.id";
$results_result = mysqli_query($conn, $results_query);

// Handle adding new category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $add_category_query = "INSERT INTO categories (name) VALUES ('$category_name')";
    mysqli_query($conn, $add_category_query);
    header('Location: admin_control.php');
    exit;
}

// Handle adding new brand
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_brand'])) {
    $brand_name = $_POST['brand_name'];
    $category_id = $_POST['category_id'];
    $add_brand_query = "INSERT INTO brands (name, category_id) VALUES ('$brand_name', '$category_id')";
    mysqli_query($conn, $add_brand_query);
    header('Location: admin_control.php');
    exit;
}

// Handle deleting a category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];

    // Delete associated brands and their results
    $delete_results_query = "DELETE results FROM results 
                             JOIN brands ON results.brand_id = brands.id 
                             WHERE brands.category_id = $category_id";
    mysqli_query($conn, $delete_results_query);

    $delete_brands_query = "DELETE FROM brands WHERE category_id = $category_id";
    mysqli_query($conn, $delete_brands_query);

    // Delete the category itself
    $delete_category_query = "DELETE FROM categories WHERE id = $category_id";
    mysqli_query($conn, $delete_category_query);

    header('Location: admin_control.php');
    exit;
}

// Handle deleting a brand
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_brand'])) {
    $brand_id = $_POST['brand_id'];

    // Delete associated results
    $delete_results_query = "DELETE FROM results WHERE brand_id = $brand_id";
    mysqli_query($conn, $delete_results_query);

    // Delete the brand itself
    $delete_brand_query = "DELETE FROM brands WHERE id = $brand_id";
    mysqli_query($conn, $delete_brand_query);

    header('Location: admin_control.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        form {
            margin-bottom: 20px;
        }
        input, select, button {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #ff6f61;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #e05550;
        }
        .update-button {
            background-color: #3498db;
        }
        .update-button:hover {
            background-color: #2980b9;
        }
        .delete-button {
            background-color: #e74c3c;
        }
        .delete-button:hover {
            background-color: #c0392b;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        /* New button for results page */
        .results-button {
            background-color: #ff6f61;            ;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0;
            width: fit-content;
        }
        .results-button:hover {
            background-color: #ff6f61;
            ;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Control Panel</h1>

        <!-- Add Category Form -->
        <form method="POST">
            <h3>Add Category</h3>
            <input type="text" name="category_name" placeholder="Category Name" required>
            <button type="submit" name="add_category">Add Category</button>
        </form>

        <!-- Add Brand Form -->
        <form method="POST">
            <h3>Add Brand</h3>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php
                $categories_result = mysqli_query($conn, $categories_query); // Refetch categories
                while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="brand_name" placeholder="Brand Name" required>
            <button type="submit" name="add_brand">Add Brand</button>
        </form>

        <!-- Display Categories -->
        <h3>Categories</h3>
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories_result = mysqli_query($conn, $categories_query); // Refetch categories
                while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <tr>
                        <td><?= $category['name']; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                                <button type="submit" name="delete_category" class="delete-button">Delete</button>
                            </form>
                            <button class="update-button" onclick="location.href='update_category.php?id=<?= $category['id']; ?>'">Update</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Display Brands with Categories -->
        <h3>Brands</h3>
        <table>
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($brand = mysqli_fetch_assoc($brands_result)): ?>
                    <tr>
                        <td><?= $brand['brand_name']; ?></td>
                        <td><?= $brand['category_name']; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="brand_id" value="<?= $brand['brand_id']; ?>">
                                <button type="submit" name="delete_brand" class="delete-button">Delete</button>
                            </form>
                            <button class="update-button" onclick="location.href='update_brand.php?id=<?= $brand['brand_id']; ?>'">Update</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Button to View Results -->
        <button class="results-button" onclick="location.href='view_results.php'">View Results</button>
    </div>
</body>
</html>

