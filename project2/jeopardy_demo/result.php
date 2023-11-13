<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy Game - Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        include 'jeopardy.php';

        if (isset($_POST['a']) && isset($_POST['correct']) && isset($_POST['q'])) {
            $selectedAnswer = $_POST['a'];
            $correctIndex = $_POST['correct'];
            $questionNumber = $_POST['q'];
            $category = floor($questionNumber / 10);
            $value = ($questionNumber % 10) - 1;

            $question = $questions[$category]["question"];
            $answers = $questions[$category]["answers"];

            echo '<div class="answer">';
            if ($selectedAnswer == $correctIndex) {
                echo '<p>Congratulations! That\'s correct!</p>';
            } else {
                echo '<p>Sorry, that\'s incorrect. The correct answer is: ' . $answers[$correctIndex] . '</p>';
            }
            echo '<a href="index.php">Back to Board</a>';
            echo '</div>';
        } else {
            header("Location: index.php");
            exit();
        }
        ?>
    </div>
</body>
</html>
