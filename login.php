<?php
// Start the session
session_start();

// Variable to hold error messages
$errorMessage = "";

// Check if there is an error message in the session (set by login_action.php)
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
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

        /* Login Form Container */
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease;
        }

        /* Form Header */
        .login-container h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .login-container p {
            text-align: center;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 30px;
        }

        /* Input Fields */
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .login-container input:focus {
            border-color: #ff6f61;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 111, 97, 0.5);
        }

        /* Login Button */
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #ff6f61;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .login-container button:hover {
            background-color: #e05550;
            transform: translateY(-2px);
        }

        /* Link to Signup */
        .login-container a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ff6f61;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        .login-container a:hover {
            color: #e05550;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Error Message */
        .error-message {
            color: red;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <p>Please enter your credentials to log in.</p>

        <!-- Display Error Message if any -->
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form action="login_action.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Don’t have an account? Sign up here!</a>
    </div>
</body>
</html>
