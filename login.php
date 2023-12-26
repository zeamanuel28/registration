<?php
$error = ""; // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

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

    // Prepare the SQL statement to retrieve user data
    $sql = "SELECT `username`, `password` FROM `signup table` WHERE `username` = '$username' AND `password` = '$password'";
    
    // Execute the SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        // Redirect to a success page or perform further actions
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form  method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Sign Up</a>
    </div>
</body>
</html>