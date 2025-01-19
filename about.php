<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f4f4f9, #e4e4f4);
            color: #333;
            margin: 0;
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: #333;
            color: #fff;
            padding: 15px 20px;
        }
        header nav {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        header nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        header nav a:hover,
        header nav a.active {
            background-color: #ff6f61;
            color: #fff;
        }

        .about-section {
            text-align: center;
            padding: 40px 20px;
        }
        .about-section h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }
        .about-section p {
            font-size: 1.2rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        .about-image {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .about-image img {
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .mission-section {
            background-color: #f9f9f9;
            padding: 40px 20px;
            text-align: center;
        }
        .mission-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
        .mission-section p {
            font-size: 1rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php" class="active">About</a>
            <a href="contact.php">Contact Us</a>
            <a href="login.php">Login</a>
            <a href="admin_login.php">Admin</a>
        </nav>
    </header>
    <main>
        <div class="about-section">
            <h1>About Us</h1>
            <div class="about-image">
                <img src="assets/images/OnlineVoting-1600x1146 (1).jpg" alt="About Us Image">
            </div>
            <p>
                Welcome to the Online Voting System, where technology meets transparency. 
                Our mission is to simplify the voting process while ensuring fairness, security, and accessibility for everyone.
            </p>
        </div>
        <div class="mission-section">
            <h2>Our Mission</h2>
            <p>
                We believe in empowering communities by providing an easy and reliable platform for online voting. 
                From category-based votes to secure access for all participants, our system is built with you in mind.
            </p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Online Voting System | All rights reserved.</p>
    </footer>
</body>
</html>
