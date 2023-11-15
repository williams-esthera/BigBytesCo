<?php 
    // For relative pathing
    require_once(__DIR__.'/Question.php');
    require_once(__DIR__.'/../enum/Category.php');
    require_once(__DIR__.'/../answer/Radio.php');
    require_once(__DIR__.'/../answer/Textbox.php');
    require_once(__DIR__.'/../answer/Checkbox.php');

    // I know this looks convoluted right now but I'll try to fix this later
    $TestingQuestions = array(
        (new Question()) 
            -> setCategory(Category::Geography)
            -> setDescription('What is the capital of France?')
            -> setMoney(400)
            -> setAnswer(
                (new Radio()) 
                    -> setCorrectAnswer('Paris')
                    -> setAnswerChoices(array('Test', 'This', 'That', 'Paris'))
        ),
        (new Question())
            -> setCategory(Category::GeneralKnowledge)
            -> setDescription('please type hotdog')
            -> setMoney(100)
            -> setAnswer(
                (new Textbox())
                    -> setCorrectAnswer('hotdog')
        ),
        (new Question())
            -> setCategory(Category::GeneralKnowledge)
            -> setDescription('Select Pineapples and Apples please')
            -> setMoney(250)
            -> setAnswer(
                (new Checkbox())
                    -> setCorrectAnswer(array('Pineapples', 'Apples'))
                    -> setAnswerChoices(array('Pineapples', 'Apples', 'Bananas', 'Pumpkins', 'Potatoes', 'Coconuts'))
            )
    );


    $GeneralKnowledge = array(
        
    );
?>