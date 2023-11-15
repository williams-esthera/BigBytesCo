<!-- win.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jeopardy Win Screen</title>
</head>
<body>
    <div class="container">
        <h1>Congratulations! You Won!</h1>
        <div class="result">
            <?php
            session_start();
            
            // Include the questions data
            include 'questions.php';

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

            $totalPoints = calculateTotalPoints($questions, $_SESSION['clicked']);
            echo '<h2>Total Points: ' . $totalPoints . '</h2>';
            ?>
            <p>Thank you for playing!</p>
            <a href="reset_board.php">Play Again</a>
        </div>
    </div>
</body>
</html>
