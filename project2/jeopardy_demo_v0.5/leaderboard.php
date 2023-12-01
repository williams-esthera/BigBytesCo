<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jeopardy Leaderboard</title>
</head>
<body>
    <div class="container">
        <h1>Jeopardy Leaderboard</h1>
        <div class="leaderboard">
            <?php
            // Read the profiles.txt file
            $profileFile = 'profiles.txt';
            $profiles = file($profileFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // Create an array to store player names and scores
            $leaderboard = [];
            foreach ($profiles as $profile) {
                $userInfo = explode('|', $profile);
                $leaderboard[$userInfo[1]] = intval($userInfo[2]); // Username as key, score as value
            }

            // Sort the leaderboard by score in descending order
            arsort($leaderboard);

            // Display the leaderboard
            echo '<ol>';
            foreach ($leaderboard as $username => $score) {
                echo "<li>$username: $score</li>";
            }
            echo '</ol>';
            ?>
            <br>
            <button><a href="main.php">Back to Main Page</a></button>
        </div>
    </div>
</body>
</html>
