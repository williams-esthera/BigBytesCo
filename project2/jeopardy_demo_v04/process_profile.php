<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player = isset($_POST['player']) ? $_POST['player'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    // Save user profile to the text file
    $profileFile = 'profiles.txt';

    // Read existing profiles
    $existingProfiles = file($profileFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Append the new profile
    $profileData = "$player|$username|0"; // Assuming 0 is the default score
    $existingProfiles[] = $profileData;

    // Save the updated profiles back to the text file
    file_put_contents($profileFile, implode("\n", $existingProfiles));

    // Set the session variable
    $_SESSION['username'] = $username;

    echo '<h1>Profile Created for players</h1>';
    // echo '<h2>Player: ' . $username . '</h2>';

    for($i = 0; $i < count($_POST['username']); $i++) {
        echo '<h2>Player: ' . $_POST['username'][$i] . '</h2>';
    }

    echo '<h1> RULES </h1>';
    echo '<p>1. Answer multiple-choice questions until all questions have been answered </p>';
    echo '<p>2. Total points will be counted at the end and be used in the leaderboard </p>';
    echo '<p>3. Questions can only be answered once and cannot be chosen again </p>';
    // echo '<button><a href="index.php">Start Game</a></button>';
    echo "<form method='post' action='./index.php'>";

    // Passes the list of new players to index.php
    for($i = 0; $i < count($_POST['username']); $i++) {
        $player = $_POST['username'][$i];
        echo "<input type='hidden' id='username' name='username[]' required value='$player' />";
    }

    echo "<button type='submit'>Start game</button>";
    echo '</form>';

    // echo '<button><a href="index.php">Start Game</a></button>';
} else {
    header("Location: main.php");
    exit();
}
?>
