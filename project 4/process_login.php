<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection and other necessary configurations

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password"];

    require_once(__DIR__.'/connection.php');
    $conn = getConnection();

    // Query to retrieve user data based on the provided email
    $query = "SELECT * FROM accounts WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['pass'];

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session and redirect to dashboard
                $_SESSION["user_id"] = $username;
                $_SESSION["id"] = $row['id'];
                header("Location: dashboard.php");
                exit;
            } else {
                // Incorrect password
                echo "Incorrect password. Please try again.";
            }
        } else {
            // User does not exist
            echo "User does not exist. Please register first.";
        }
    } else {
        // Query execution error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
