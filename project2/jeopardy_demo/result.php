<?php
session_start();

if (isset($_POST['a']) && isset($_POST['correct']) && isset($_POST['q'])) {
    $selectedAnswer = $_POST['a'];
    $correctAnswer = $_POST['correct'];
    $q = $_POST['q'];

    $category = floor($q / 10);
    $value = ($q % 10) - 1;

    // Include the questions data
    include 'questions.php';

    $question = $questions[$category]["questions"][$value];
    $selectedAnswerText = $questions[$category]["answers"][$value][$selectedAnswer];
    $correctAnswerText = $questions[$category]["answers"][$value][$correctAnswer];

    $isCorrect = $selectedAnswer == $correctAnswer;

    // Adds point to current player turn
    if($isCorrect) {
        echo $_SESSION['players'][$_SESSION['turn']];
        $_SESSION['players'][$_SESSION['turn']] += $questions[$category]['points'][$value];
    }

    // Store whether the answer is correct in the session
    $_SESSION['correct'][$q] = $isCorrect;
} else {
    // Redirect to the main page if the data is not set
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jeopardy Result</title>
</head>
<body>
    <div class="container">
        <h3>Jeopardy Result...</h3>
        <div class="result">
            <?php
            if ($isCorrect) {
                echo '<h1 class="correct">Correct!</h1>';
            } else {
                echo '<h1 class="wrong">Wrong!</h1>';
            }

            // Goes to next turn
            $i = 0;
            foreach($players as $player => $points) {
                $i++;
                if($player == $_SESSION['turn']) {
                    break;
                }
            }

            echo $i;
            echo '<br>';

            if($i == count($_SESSION['players']) - 1) {
                $_SESSION['turn'] = $_SESSION['players'][0];
            } else {
                $j = 0;
                foreach($players as $player => $points) {
                    $j++;
                    if($i == $j) {
                        $_SESSION['turn'] = $player;
                        break;
                    }
                }
            }

            ?>
            <p>Your answer: <?php echo $selectedAnswerText; ?></p>
            <p>Correct answer: <?php echo $correctAnswerText; ?></p>
            <p>Question: <?php echo $question; ?></p>
            <a href="index.php">Back to Board</a>
        </div>
    </div>
</body>
</html>
