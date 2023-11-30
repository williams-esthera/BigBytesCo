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

        $number = $_POST["questionNumber"];

        $question = $TestingQuestions[$number];
        $category = $question -> category == Category::GeneralKnowledge ? "General Knowledge" : $question -> category -> name;

        echo '<div class="question">';
        echo '<h2>' . $category . '</h2>';
        echo '<p>' . $question -> description . '</p>';
        
        echo '<form method="post" action="./validateQuestion.php">';
        $question -> answer -> displayAnswer();

        echo "<input type='hidden' id='questionNumber' name='questionNumber' value='$number' />";

        echo '</form>';

        $correct = $question -> answer -> validateAnswer($_POST["answer"]);
        echo $correct . "!";
        echo "<br> <br>";

        echo '<a href="index.php">Back to Board</a>';
        echo '</div>';
        ?>
    </div>
</body>
</html>


<?php 

// require_once(__DIR__.'/dependencies.php');


// echo "Validating question";
// echo "<br> <br>";

// print_r($_POST);
// echo "<br> <br>";

// $question = $TestingQuestions[$_POST["questionNumber"]];

// print_r($question);
// echo "<br> <br>";

// $correct = $question -> answer -> validateAnswer($_POST["answer"]);
// echo $correct;
// echo "<br> <br>";

// if($correct == "Correct") {
//     echo "won " . $question -> money;
// } else {
//     echo "lost " . $question -> money;
// }

// echo "<br> <br>";
// echo "<a href='./index.php'>Back</a>";

?>