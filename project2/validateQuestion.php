
<?php

require_once(__DIR__.'/dependencies.php');


echo "Validating question";
echo "<br> <br>";

print_r($_POST);
echo "<br> <br>";

$question = $GeneralKnowledge[$_POST["questionNumber"]];

print_r($question);
echo "<br> <br>";

$correct = $question -> answer -> validateAnswer($_POST["answer"]);
echo $correct;
echo "<br> <br>";

if($correct == "Correct") {
    echo "won " . $question -> money;
} else {
    echo "lost " . $question -> money;
}

echo "<br> <br>";
echo "<a href='./index.php'>Back</a>";

?>