<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy Game</title>
    <link rel="stylesheet" href="./components/style.css">
</head>
<body>
    <div class="container">
        <?php 
        require_once(__DIR__.'/dependencies.php');

        $number = rand(0, count($TestingQuestions) - 1);

        $question = $TestingQuestions[$number];
        $category = $question -> category == Category::GeneralKnowledge ? "General Knowledge" : $question -> category -> name;

        echo '<div class="question">';
        echo '<h2>' . $category . '</h2>';
        echo '<p>' . $question -> description . '</p>';
        
        echo '<form method="post" action="./validateQuestion.php">';
        $question -> answer -> displayAnswer();

        echo "<input type='hidden' id='questionNumber' name='questionNumber' value='$number' />";

        echo '</form>';

        echo '<a href="index.php">Back to Board</a>';
        echo '</div>';
        ?>
    </div>
</body>
</html>


<?php 




// For now, picks a random question and validates it


// echo '<div class="question">';
// echo '<h2>' . $categories[$category] . '</h2>';
// echo '<p>' . $question . '</p>';

// echo '<form method="post" action="result.php">';
// foreach ($answers as $index => $answer) {
//     echo '<button type="submit" name="a" value="' . $index . '" class="answer-button">' . $answer . '</button>';
// }
// echo '<input type="hidden" name="correct" value="' . $correctIndex . '">';
// echo '<input type="hidden" name="q" value="' . $q . '">';
// echo '</form>';

// echo '<a href="index.php">Back to Board</a>';
// echo '</div>';

?>