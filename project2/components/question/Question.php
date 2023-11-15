<?php 
    
class Question {
    public Category $category;
    public $description;
    public Answer $answer;
    public $money;

    function setCategory(Category $category) {
        $this -> category = $category;
        return $this;
    }

    function setDescription($description) {
        $this -> description = $description;
        return $this;
    }

    function setAnswer(Answer $answer) {
        $this -> answer = $answer;
        return $this;
    }

    function setMoney($money) {
        $this -> money = $money;
        return $this;
    }

}

?>