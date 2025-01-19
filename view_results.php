<?php
// view_results.php - Display Voting Results

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




// Fetch results from the database, grouping by brand and category, and calculating vote percentages
$query = "
    SELECT 
        categories.name AS category_name, 
        brands.name AS brand_name, 
        SUM(results.vote_count) AS total_votes,
        (SUM(results.vote_count) / category_total_votes.total_votes) * 100 AS vote_percentage
    FROM results
    JOIN categories ON results.category_id = categories.id
    JOIN brands ON results.brand_id = brands.id
    JOIN (
        SELECT category_id, SUM(vote_count) AS total_votes
        FROM results
        GROUP BY category_id
    ) AS category_total_votes ON results.category_id = category_total_votes.category_id
    GROUP BY categories.name, brands.name
    ORDER BY categories.name, total_votes DESC
";

$results = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .results-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f1f1f1;
        }
        h1 {
            text-align: center;
        }
        .category-section {
            margin-top: 30px;
        }
        .category-title {
            font-size: 1.5rem;
            color: #007BFF;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h1>Voting Results</h1>

        <!-- Loop through results and display them by category -->
        <?php 
        $current_category = '';
        while ($row = mysqli_fetch_assoc($results)): 
            // If the category changes, start a new section
            if ($current_category !== $row['category_name']) {
                if ($current_category !== '') {
                    echo '</tbody></table>'; // Close the previous table
                }
                $current_category = $row['category_name'];
                echo "<div class='category-section'>
                        <div class='category-title'>$current_category</div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Votes</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>";
            }
            ?>
            <tr>
                <td><?= $row['brand_name']; ?></td>
                <td><?= $row['total_votes']; ?></td>
                <td><?= number_format($row['vote_percentage'], 2); ?>%</td>
            </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
    </div>
</body>
</html>
