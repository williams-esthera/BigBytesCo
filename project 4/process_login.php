<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection and other necessary configurations

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password"];

    // define("DB_NAME","ewilliams153");
    // define("DB_USER","ewilliams153");
    // define("DB_PASSWORD","ewilliams153");
    // define("DB_HOST","localhost");
    define("DB_NAME","property");
    define("DB_USER","root");
    define("DB_PASSWORD","password");
    define("DB_HOST","172.17.0.2");
    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

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
