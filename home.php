<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="hero">
            <h1>Welcome to My Website</h1>
        </section>

        <section id="contact">
            <p>For any inquiries or feedback, please feel free to contact us using the form below:</p>
            <form action="contact.php" method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Database credentials
        $hostname = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $database = 'home_db';

        // Create a new database connection
        $conn = new mysqli($hostname, $db_username, $db_password, $database);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to insert user data
        $sql = "INSERT INTO `home_table`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
        
        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            // Redirect to a success page or perform further actions
            header("Location: home.php");
            exit();
        } else {
            // Error occurred while inserting data
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>