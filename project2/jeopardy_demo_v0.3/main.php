<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Jeopardy!</h1>
        <p>Please create a profile to start playing.</p>

        <form action='./create_profile.php' method='post'>

            <label for='player-count'>Player count:</label>
            <input type='number' id='player-count' name='player-count' min='1' max='8'>
            <br>
            <button type='submit'>Create profile(s)</button>
        </form>

        <!-- <a href="create_profile.php">Create Profile</a> -->
    </div>
</body>
</html>
