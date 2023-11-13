<?php 

require_once(__DIR__.'/Answer.php');

class Checkbox implements Answer {

    public $correctAnswer;
    public $answerChoices;

    function validateAnswer($answer) {
        if($answer == null) { return 'Wrong'; }
        $correctAnswers = $this -> correctAnswer;

        if(count($correctAnswers) != count($answer)) {
            return 'Wrong';
        }
        for($i = 0; $i < count($answer); $i++) {
            $found = False;
            for($j = 0; $j < count($correctAnswers); $j++) {
                if($answer[$i] == $correctAnswers[$j]) {
                    $found = True;
                    break;
                }
            }
            if($found == False) {
                return 'Wrong';
            }
        }

        
        return 'Correct';
    }

    function displayAnswer() {
        echo "<form method='post' action='./validateQuestion.php'>";        

        echo "<div>";
        for($i = 0; $i < count($this -> answerChoices); $i++) {
            $answer = $this -> answerChoices[$i];
            echo "<input type='checkbox' value=$answer name='answer[]' />";
            echo "<label for='$answer'>$answer</label>";
        }
        echo "</div>";

        echo "<button type='submit'>Submit</button>";
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