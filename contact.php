<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            height: 100%;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
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
            flex: 1;
            padding: 40px 20px;
            text-align: center;
        }
        main h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }
        main p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .contact-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .contact-form button {
            background-color: #ff6f61;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color: #e05550;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
        }

        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .popup h2 {
            color: #28a745;
        }
        .popup .emoji {
            font-size: 3rem;
            animation: bounce 1s infinite;
        }
        /* Bounce Animation */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            main h1 {
                font-size: 2rem;
            }
            main p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <header>
            <nav>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php" class="active">Contact Us</a>
                <a href="login.php">Login</a>
                <a href="admin.php">Admin</a>
            </nav>
        </header>

        <!-- Main Content -->
        <main>
            <h1>Contact Us</h1>
            <p>Have questions, feedback, or need assistance? Reach out to us, and we’ll get back to you as soon as possible.</p>
            <div class="contact-form">
                <form id="contactForm">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>

                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Online Voting System. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- Popup -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2>Message Sent!</h2>
        <div class="emoji">😊</div>
        <p>Thank you for contacting us. We will get back to you shortly.</p>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Show the popup
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';

            // Optionally, you can clear the form fields
            document.getElementById('contactForm').reset();

            // Hide the popup after 3 seconds
            setTimeout(function() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }, 3000);
        });
    </script>
</body>
</html>
