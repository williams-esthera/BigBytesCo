<?php 
    // For relative pathing
    require_once(__DIR__.'/Question.php');
    require_once(__DIR__.'/../enum/Category.php');
    require_once(__DIR__.'/../answer/MultipleChoice.php');
    require_once(__DIR__.'/../answer/Textbox.php');
    require_once(__DIR__.'/../answer/Checkbox.php');

    // I know this looks convoluted right now but I'll try to fix this later
    $GeneralKnowledge = array(
        (new Question()) 
            -> setCategory(Category::Geography)
            -> setDescription('What is the capital of France?')
            -> setMoney(400)
            -> setAnswer(
                (new MultipleChoice()) 
                    -> setCorrectAnswer('Paris')
                    -> setAnswerChoices(array('Test', 'This', 'That', 'Paris'))
        ),
        (new Question())
            -> setCategory(Category::GeneralKnowledge)
            -> setDescription('2 + 2 = 4')
            -> setMoney(100)
            -> setAnswer(
                (new MultipleChoice())
                    -> setCorrectAnswer('True')
                    -> setAnswerChoices(array('True', 'False'))
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

?>