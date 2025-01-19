<?php
// thank_you.php - Acknowledge the user for voting

// Optional: Database connection for logging or tracking, if needed.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Voting</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff6f61, #f4f4f9);
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .thank-you-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h1 {
            color: #ff6f61;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6f61;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }
        a:hover {
            background-color: #e05550;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <h1>Thank You for Voting!</h1>
        <p>Your vote has been successfully recorded.</p>
        <p>We appreciate your participation in the voting process.</p>
        <a href="vote_interface.php">Vote Again</a>
    </div>
</body>
</html>
