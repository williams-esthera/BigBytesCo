<?php
$categories = array("General Knowledge", "Science", "History", "Geography", "Movies");

$questions = array(
    array("What is the capital of France?", "Who wrote 'Romeo and Juliet'?", "What is the largest mammal on Earth?", "In which year did World War II end?", "Who played the role of Iron Man in the Marvel movies?"),
    array("What is the chemical symbol for water?", "How many planets are there in our solar system?", "What is the powerhouse of the cell?", "Who developed the theory of relativity?", "What is the process by which plants make their own food?"),
    array("In which year did the Titanic sink?", "Who was the first president of the United States?", "What is the currency of Japan?", "Who painted the Mona Lisa?", "When did the Apollo 11 mission land on the moon?"),
    array("Which river is the longest in the world?", "What is the capital of Australia?", "In which continent is the Sahara Desert located?", "What is the Great Barrier Reef?", "What is the capital of Brazil?"),
    array("Who directed 'The Shawshank Redemption'?", "In which year was the first 'Star Wars' movie released?", "What is the highest-grossing film of all time?", "Who played Jack Dawson in 'Titanic'?", "What is the name of the wizarding school in Harry Potter?")
);

// Check if a question is selected
if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $category = floor($q / 10);
    $value = ($q % 10) - 1;
    
    echo '<div class="question">';
    echo '<h2>' . $categories[$category] . '</h2>';
    echo '<p>' . $questions[$category][$value] . '</p>';
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

    for ($i = 0; $i < count($questions[0]); $i++) {
        echo '<tr>';
        echo '<td><strong>' . ($i + 1) . '</strong></td>';
        for ($j = 0; $j < count($categories); $j++) {
            $questionNumber = ($j * 10) + ($i + 1);
            echo '<td><button type="submit" name="q" value="' . $questionNumber . '">' . $questions[$j][$i] . '</button></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</form>';
}
?>