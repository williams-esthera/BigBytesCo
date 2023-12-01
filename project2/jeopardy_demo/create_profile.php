<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create Your Profile</h1>
        <form action="process_profile.php" method="post">
            
            <?php 
            
            for($i = 0; $i < $_POST["player-count"]; $i++) {
                $username = 'username' . $i;
                echo "<label for='username[]'>Username " . ($i + 1) . ": ";
                echo "<input type='text' id='username' name='username[]' required />";
                echo "<br>";
            }

            ?>

            <!-- <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br> -->

            <button type="submit">Create Profile</button>
        </form>
        <br>
        <a href="main.php">Back to Home</a>
    </div>
</body>
</html>
