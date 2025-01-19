<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f4f4f9, #eaeaea);
            color: #333;
            margin: 0;
            padding: 0;
            height: 100%; /* Ensure body takes full height */
        }
        
        /* Wrapper */
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Makes sure the content stretches to full viewport height */
        }

        /* Header and Navigation */
        header {
            background-color: #333;
            color: #fff;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        header nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        header nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }
        header nav a:hover,
        header nav a.active {
            background-color: #ff6f61;
            color: #fff;
            transform: scale(1.1);
        }

        /* Main Section */
        main {
            flex: 1; /* Allows the main content to grow and push footer down */
            text-align: center;
            padding: 40px 20px;
        }
        main h1 {
            font-size: 3rem;
            color: #333;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }
        main p {
            font-size: 1.5rem;
            color: #555;
            max-width: 800px;
            margin: 0 auto 30px;
            line-height: 1.8;
        }
        main .cta {
            display: inline-block;
            background-color: #ff6f61;
            color: #fff;
            font-size: 1.2rem;
            text-transform: uppercase;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 5px 10px rgba(255, 111, 97, 0.4);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        main .cta:hover {
            background-color: #e05550;
            transform: translateY(-5px);
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeInDown {
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
            main h1 {
                font-size: 2rem;
            }
            main p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <header>
            <nav>
                <a href="index.php" class="active">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact Us</a>
                <a href="login.php">Login</a>
                <a href="admin.php">Admin</a>
            </nav>
        </header>

        <!-- Main Content -->
        <main>
            <h1>Welcome to the Online Voting System</h1>
            <p>
                Participate in a secure, dynamic, and user-friendly platform for voting on your favorite categories and brands.
                Make your vote count and explore what others are voting for!
            </p>
            <a href="login.php" class="cta">Get Started</a>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Online Voting System. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
