<?php 

require_once(__DIR__.'/Answer.php');

class Textbox implements Answer {

    public $correctAnswer;

    function validateAnswer($answer) {
        if($this -> correctAnswer == strtolower($answer)) {
            return "Correct";
        }
        return "Wrong";
    }

    function displayAnswer() {
        echo "<form method='post' action='./validateQuestion.php'>";
        
        // echo "<label for='answer'>Answer:</label>";
        echo "<div>";
        echo "<input type='text' name='answer' placeholder='Enter answer here'>";
        echo "</div>";

        echo "<button type='submit'>Submit</button>";
    }

    function setCorrectAnswer($correctAnswer) {
        $this -> correctAnswer = $correctAnswer;
        return $this;
    }
}

?>