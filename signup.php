<?php
$error = ""; // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password == $confirm_password) {
        // Database credentials
        $hostname = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $database = 'signup db';

        // Create a new database connection
        $conn = new mysqli($hostname, $db_username, $db_password, $database);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to insert user data
        $sql = "INSERT INTO `signup table`(`username`, `password`) VALUES ('$username','$password')";

        // Execute the SQL statement
        if ($conn->query($sql) === true) {
            echo "Data inserted successfully";
            // Redirect to a success page or login page
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        $error = "Passwords do not match";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form action="signup.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php">Login</a>
    </div>
</body>
</html>