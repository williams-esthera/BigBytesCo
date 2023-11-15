<?php 

require_once(__DIR__.'/Answer.php');

class Radio implements Answer {

    public $correctAnswer;
    public $answerChoices;

    function validateAnswer($answer) {
        if($this -> correctAnswer == $answer) {
            return "Correct";
        }
        return "Wrong";
    }

    function displayAnswer() {
        echo "<form method='post' action='./validateQuestion.php'>";        
        for($i = 0; $i < count($this -> answerChoices); $i++) {
            $answer = $this -> answerChoices[$i];
            // echo "<input type='radio' value=$answer name='answer' class='answer-button' />";
            echo '<button type="submit" name="answer" value="' . $answer . '" class="answer-button">' . $answer . '</button>';
            // echo "<label for='$answer'>$answer</label>";
        }

        // echo "<button type='submit'>Submit</button>";
    }

    function setCorrectAnswer($correctAnswer) {
        $this -> correctAnswer = $correctAnswer;
        return $this;
    }

    function setAnswerChoices($answerChoices) {
        $this -> answerChoices = $answerChoices;
        return $this;
    }
}

?>