

<?php 

require_once(__DIR__.'/dependencies.php');


// For now, picks a random question and validates it
$number = rand(0, count($TestingQuestions) - 1);

$question = $TestingQuestions[$number];

print_r($question);

echo "<br> <br>";
echo $question -> description;
$question -> answer -> displayAnswer();

echo "<input type='hidden' id='questionNumber' name='questionNumber' value='$number' />";
echo "</form>";

?>