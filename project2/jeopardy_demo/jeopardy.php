<?php
session_start();
include 'questions.php';

// Initialize 'clicked' session variable if not set
if (!isset($_SESSION['clicked'])) {
    $_SESSION['clicked'] = array();

    // Points for each player
    for($i = 0; $i < count($_POST['username']); $i++) {
        $username = $_POST['username'][$i];
        $_SESSION['players'][$username] = 0;
        $players[$username] = 0; 
    }

    $_SESSION['turn'] = $_POST['username'][0];
}

print_r($_SESSION);

// Function to calculate total points
function calculateTotalPoints($questions, $clicked) {
    $totalPoints = 0;

    foreach ($clicked as $questionNumber => $clickedValue) {
        if ($clickedValue) {
            $categoryIndex = floor($questionNumber / 10);
            $questionIndex = ($questionNumber % 10) - 1;

            // Check if the question was answered correctly
            if (isset($_SESSION['correct'][$questionNumber]) && $_SESSION['correct'][$questionNumber]) {
                $totalPoints += $questions[$categoryIndex]["points"][$questionIndex];
            }
        }
    }

    return $totalPoints;
}

// Check if all questions are selected
$allQuestionsSelected = true;
foreach ($questions as $category) {
    foreach ($category["questions"] as $i => $question) {
        $questionNumber = ($category["points"][$i] / 100) + ($i + 1);
        if (!isset($_SESSION['clicked'][$questionNumber])) {
            $allQuestionsSelected = false;
            break 2; // Break both loops
        }
    }
}

// Check if all questions are selected
if ($allQuestionsSelected) {
    // Calculate final points
    $finalPoints = calculateTotalPoints($questions, $_SESSION['clicked']);

    // Redirect to win screen
    header("Location: win.php?points=" . $finalPoints);
    exit();
}

// Display the current score
echo '<div class="total-points">';
$currentPoints = calculateTotalPoints($questions, $_SESSION['clicked']);

$players = $_SESSION['players'];
foreach($players as $player => $points) {
    echo "<h2>" . $player . ": " . $points . "</h2>";
}

echo '<h2>Current turn: ' . $_SESSION['turn'] . '</h2>';
// echo '<h2>Current Points: ' . $currentPoints . '</h2>';



echo '</div>';

// Check if a question is selected
if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $category = floor($q / 10);
    $value = ($q % 10) - 1;

    // Check if the question has already been selected
    if (!isset($_SESSION['clicked'][$q])) {
        $question = $questions[$category]["questions"][$value];
        $answers = $questions[$category]["answers"][$value];
        $correctIndex = $questions[$category]["correct"][$value];

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

        echo '</div>';

        // Mark the question as clicked in session
        $_SESSION['clicked'][$q] = true;
    } else {
        echo '<p>This question has already been selected.</p>';
        echo '<a href="index.php">Back to Board</a>';
    }
} else {
    echo '<form method="post" action="index.php">';
    echo '<table>';
    echo '<tr>';
    echo '<th></th>';
    foreach ($categories as $category) {
        echo '<th>' . $category . '</th>';
    }
    echo '</tr>';

    for ($i = 0; $i < count($questions[0]["questions"]); $i++) {
        echo '<tr>';
        echo '<td><strong>' . ($i + 1) . '</strong></td>';

        // Inside your loop where you echo the buttons
        for ($j = 0; $j < count($categories); $j++) {
            $questionNumber = ($j * 10) + ($i + 1);

            // Check if the question has already been selected
            if (isset($_SESSION['clicked'][$questionNumber])) {
                // Question already selected, display the question text on the button
                echo '<td><button disabled>' . $questions[$j]["questions"][$i] . '</button></td>';
            } else {
                // Question available to select
                echo '<td><button type="submit" name="q" value="' . $questionNumber . '">' . '$' . $questions[$j]["points"][$i] . '</button></td>';
            }
        }

        echo '</tr>';
    }
    echo '</table>';
    echo '</form>';
}
?>
