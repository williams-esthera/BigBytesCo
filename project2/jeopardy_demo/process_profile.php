<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // $player = isset($_POST['player']) ? $_POST['player'] : '';
    // $username = isset($_POST['username']) ? $_POST['username'] : '';

    // echo '<h1>Profile Created for Player ' . $player . '</h1>';
    // echo '<h2>Player: ' . $username . '</h2>';

    echo '<h1>Profile Created for players</h1>';

    for($i = 0; $i < count($_POST['username']); $i++) {
        echo '<h2>Player: ' . $_POST['username'][$i] . '</h2>';
    }
    
    echo '<h1> RULES </h1>';
    echo '<p>1. Answer multiple choice questions until all questions have been answered </p>';
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

    // echo '<p><a href="index.php">Start Game</a></p>';
} else {
    header("Location: main.php");
    exit();
}
?>
