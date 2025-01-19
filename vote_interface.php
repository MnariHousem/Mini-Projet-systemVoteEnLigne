<?php
// vote_interface.php - Voting interface where users can vote for categories and brands

// Old database connection method
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .vote-container {
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
        select, button {
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
        select {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="vote-container">
        <h1>Vote for Your Favorite Brand</h1>

        <form method="POST" action="vote_action.php">
            <select name="category_id" id="category-select" required>
                <option value="">Select Category</option>
                <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php endwhile; ?>
            </select>

            <select name="brand_id" id="brand-select" required>
                <option value="">Select Brand</option>
                <!-- Brands will be dynamically populated based on the selected category -->
            </select>

            <button type="submit">Vote</button>
        </form>
    </div>

    <script>
        // Dynamically update brands based on selected category
        const categorySelect = document.getElementById('category-select');
        const brandSelect = document.getElementById('brand-select');

        categorySelect.addEventListener('change', function() {
            const categoryId = categorySelect.value;
            if (!categoryId) return;

            // Fetch brands from the server based on selected category
            fetch('get_brands.php?category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    brandSelect.innerHTML = '<option value="">Select Brand</option>';  // Clear previous brands
                    data.forEach(brand => {
                        brandSelect.innerHTML += `<option value="${brand.id}">${brand.name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching brands:', error);
                });
        });
    </script>
</body>
</html>
