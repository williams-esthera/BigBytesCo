<?php 

class Team {

    public $name;
    public $points;

    function setName($name) {
        $this -> name = $name;
        $this -> points = 0;
    }

    function setPoints($points) {
        $this -> points = $points;
    }

    function addPoints($points) {
        $this -> points = $this -> points + $points;
    }
}

?>