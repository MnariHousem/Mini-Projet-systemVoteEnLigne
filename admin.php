
<?php
session_start();

// Static admin credentials (stored directly in PHP for simplicity)
$admin_username = "admin";
$admin_password = "admin123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];

    if ($username === $admin_username && $password === $admin_password) {
        // Successful login
        $_SESSION['admin'] = $username;
        header("Location: admin_control.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #333, #555);
            color: #f4f4f9;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Login Form Container */
        .admin-login-container {
            background: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease;
        }

        /* Form Header */
        .admin-login-container h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ff6f61;
        }
        .admin-login-container p {
            text-align: center;
            font-size: 0.9rem;
            color: #ccc;
            margin-bottom: 30px;
        }

        /* Input Fields */
        .admin-login-container input[type="text"],
        .admin-login-container input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #555;
            border-radius: 5px;
            font-size: 1rem;
            background: #333;
            color: #fff;
            transition: border-color 0.3s ease;
        }
        .admin-login-container input:focus {
            border-color: #ff6f61;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 111, 97, 0.5);
        }

        /* Login Button */
        .admin-login-container button {
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
        .admin-login-container button:hover {
            background-color: #e05550;
            transform: translateY(-2px);
        }

        /* Return to Home Link */
        .admin-login-container a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ff6f61;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        .admin-login-container a:hover {
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-login-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <h1>Admin Login</h1>
        <p>Enter your admin credentials to manage the system.</p>
        <?php if (isset($error)) : ?>
            <p style="color: red; text-align: center;"><?= $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="admin_username" placeholder="Admin Username" required>
            <input type="password" name="admin_password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>

