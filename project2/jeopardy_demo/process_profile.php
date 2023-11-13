<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Perform profile creation logic (you can save the profile information to a database)

    // For demonstration purposes, let's just display the created profile
    echo '<h1>Profile Created</h1>';
    echo '<p>Username: ' . $username . '</p>';
    echo '<p>Email: ' . $email . '</p>';
    echo "<a href='index.php'>Start a game</a>";
} else {
    header("Location: main.php");
    exit();
}
?>
