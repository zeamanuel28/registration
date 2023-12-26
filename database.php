<?php
// Include the necessary files
include("database.php");

// Check if the form is submitted
if (isset($_POST["login"])) {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the form data
    if (!empty($username) && !empty($password)) {
        // Prepare a database query
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the query result
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows == 1) {
            // Fetch the user data
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user["password"])) {
                // Start the user session
                $_SESSION["username"] = $user["username"];
                $_SESSION["user_id"] = $user["id"];

                // Redirect to the user page
                header("Location: userPage.php");
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Enter valid username and password";
    }
}
?>