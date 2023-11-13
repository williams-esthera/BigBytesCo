<?php
$categories = array("General Knowledge", "Science", "History", "Geography", "Movies");

$questions = array(
    array(
        "question" => "What is the capital of France?",
        "answers" => array("Berlin", "London", "Paris", "Madrid", "Rome"),
        "correct" => 2
    ),
    array(
        "question" => "Who wrote 'Romeo and Juliet'?",
        "answers" => array("William Shakespeare", "Charles Dickens", "Jane Austen", "Mark Twain", "Leo Tolstoy"),
        "correct" => 0
    ),
    array(
        "question" => "What is the largest mammal on Earth?",
        "answers" => array("Elephant", "Blue Whale", "Giraffe", "Kangaroo", "Polar Bear"),
        "correct" => 1
    ),
    array(
        "question" => "In which year did World War II end?",
        "answers" => array("1943", "1945", "1950", "1939", "1941"),
        "correct" => 1
    ),
    array(
        "question" => "Who played the role of Iron Man in the Marvel movies?",
        "answers" => array("Chris Evans", "Chris Hemsworth", "Robert Downey Jr.", "Mark Ruffalo", "Scarlett Johansson"),
        "correct" => 2
    ),
);

// Check if a question is selected
if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $category = floor($q / 10);
    $value = ($q % 10) - 1;
    
    $question = $questions[$category]["question"];
    $answers = $questions[$category]["answers"];
    $correctIndex = $questions[$category]["correct"];

    echo '<div class="question">';
    echo '<h2>' . $categories[$category] . '</h2>';
    echo '<p>' . $question . '</p>';

    echo '<form method="post" action="result.php">';
    foreach ($answers as $index => $answer) {
        echo '<button type="submit" name="a" value="' . $index . '" class="answer-button">' . $answer . '</button>';
    }
    echo '<input type="hidden" name="correct" value="' . $correctIndex . '">';
    echo '<input type="hidden" name="q" value="' . $q . '">';
    echo '</form>';

    echo '<a href="index.php">Back to Board</a>';
    echo '</div>';
} else {
    // Display the game board
    echo '<form method="post" action="index.php">';
    echo '<table>';
    echo '<tr>';
    echo '<th></th>';
    foreach ($categories as $category) {
        echo '<th>' . $category . '</th>';
    }
    echo '</tr>';

    for ($i = 0; $i < count($questions[0]["answers"]); $i++) {
        echo '<tr>';
        echo '<td><strong>' . ($i + 1) . '</strong></td>';
        for ($j = 0; $j < count($categories); $j++) {
            $questionNumber = ($j * 10) + ($i + 1);
            echo '<td><button type="submit" name="q" value="' . $questionNumber . '">' . $questions[$j]["question"] . '</button></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</form>';
}
?>
