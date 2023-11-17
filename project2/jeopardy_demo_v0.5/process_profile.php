<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Game Rules</title>
		<link rel="stylesheet" href="style.css">
	</head>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerCount = isset($_POST['player-count']) ? $_POST['player-count'] : 1;
    $usernames = isset($_POST['usernames']) ? $_POST['usernames'] : [];

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
    $_SESSION['username'] = $usernames[0];

	echo '<div class = "flex-container">';
    // Display the inputted usernames
   // echo '<h1>Profiles Created!</h1>';
	
   for($i = 0; $i < count($_POST['username']); $i++) {
        echo '<h2>Player: ' . $_POST['username'][$i] . '</h2>';
    }

    echo '<h1 class = "title"> RULES </h1>';
    echo '<p>1. Answer multiple-choice questions until all questions have been answered </p>';
    echo '<p>2. Total points will be counted at the end and be used in the leaderboard </p>';
    echo '<p>3. Questions can only be answered once and cannot be chosen again </p>';
	
    echo "<form method='post' action='./index.php'>";
    // Passes the list of new players to index.php
    for($i = 0; $i < count($_POST['username']); $i++) {
        $player = $_POST['username'][$i];
        echo "<input type='hidden' id='username' name='username[]' required value='$player' />";
    }
    echo "<button type='submit'>Start game</button>";
    echo '</form>';
	echo '</div>';
} else {
    header("Location: main.php");
    exit();
}
?>
</html>