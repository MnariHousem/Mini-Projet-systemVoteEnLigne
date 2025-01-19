<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "voting_system"; // Correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables to hold error messages
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Non-encrypted password

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        $errorMessage = "All fields are required!";
    } else {
        // Check if the email already exists in the database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $errorMessage = "Email is already used!";
        } else {
            // SQL query to insert data into users table
            $sql = "INSERT INTO users (name, email, password, created_at) 
                    VALUES ('$name', '$email', '$password', NOW())";

            if ($conn->query($sql) === TRUE) {
                // Redirect to login page after successful signup
                header("Location: login.php");
                exit();
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>

<!-- Show error message if any -->
<?php if ($errorMessage): ?>
    <script>alert("<?php echo $errorMessage; ?>");</script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f4f4f9, #eaeaea);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Form Container */
        .signup-container {
            background: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form Header */
        .signup-container h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        /* Input Fields */
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .signup-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff6f61;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #e05550;
        }

        /* Error Message */
        .error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 10px;
            text-align: center;
        }

        /* Return to Login Link */
        .signup-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }

        .signup-container a:hover {
            color: #ff6f61;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Sign Up</h1>
        
        <!-- Display Error Message if any -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>

        <!-- Sign Up Form -->
        <form method="POST" action="signup.php">
            <input type="text" name="name" placeholder="Enter your name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Sign Up">
        </form>

        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
