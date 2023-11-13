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
        
        echo "<input type='text' name='answer'>";
        echo "<label for='answer'>Answer:</label>";

        echo "<button type='submit'>Submit</button>";
    }

    function setCorrectAnswer($correctAnswer) {
        $this -> correctAnswer = $correctAnswer;
        return $this;
    }
}

?>