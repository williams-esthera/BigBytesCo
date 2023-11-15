<?php
$categories = array("General Knowledge", "Science", "History", "Geography", "Movies");

$questions = array(
    array(
        "questions" => array(
            "What is the capital of Japan?",
            "Who developed the theory of relativity?",
            "What ancient civilization built the pyramids?",
            "Which river is the longest in the world?",
            "Who directed the movie 'Inception'?"
        ),
        "answers" => array(
            array("Beijing", "Seoul", "Tokyo", "Bangkok", "Hanoi"),
            array("Isaac Newton", "Galileo Galilei", "Albert Einstein", "Niels Bohr", "Stephen Hawking"),
            array("Maya", "Inca", "Aztec", "Egyptian", "Mesopotamian"),
            array("Amazon", "Nile", "Yangtze", "Mississippi", "Danube"),
            array("Christopher Nolan", "Quentin Tarantino", "Steven Spielberg", "Martin Scorsese", "James Cameron")
        ),
        "correct" => array(2, 2, 3, 0, 0),
        "points" => array(100, 200, 300, 400, 500)
    ),
    array(
        "questions" => array(
            "What is the largest planet in our solar system?",
            "Who painted the Mona Lisa?",
            "In what year did the Titanic sink?",
            "What is the currency of Brazil?",
            "Who wrote 'The Great Gatsby'?"
        ),
        "answers" => array(
            array("Earth", "Jupiter", "Mars", "Venus", "Saturn"),
            array("Vincent van Gogh", "Leonardo da Vinci", "Pablo Picasso", "Claude Monet", "Michelangelo"),
            array("1905", "1912", "1920", "1931", "1941"),
            array("Peso", "Euro", "Yen", "Dollar", "Real"),
            array("F. Scott Fitzgerald", "Ernest Hemingway", "Jane Austen", "Mark Twain", "Charles Dickens")
        ),
        "correct" => array(1, 1, 1, 4, 0),
        "points" => array(100, 200, 300, 400, 500)
    ),
    array(
        "questions" => array(
            "Which element has the chemical symbol 'O'?",
            "What is the capital of Australia?",
            "Who wrote 'To Kill a Mockingbird'?",
            "What is the speed of light?",
            "In what year did the Berlin Wall fall?"
        ),
        "answers" => array(
            array("Osmium", "Oxygen", "Oganesson", "Olivine", "Osmosis"),
            array("Sydney", "Melbourne", "Canberra", "Brisbane", "Adelaide"),
            array("J.K. Rowling", "Harper Lee", "George Orwell", "Mark Twain", "Ernest Hemingway"),
            array("300,000 km/s", "150,000 km/s", "600,000 km/s", "450,000 km/s", "750,000 km/s"),
            array("1985", "1989", "1991", "1980", "1995")
        ),
        "correct" => array(1, 2, 1, 0, 1),
        "points" => array(100, 200, 300, 400, 500)
    ),
    array(
        "questions" => array(
            "Which planet is known as the 'Red Planet'?",
            "Who played Neo in 'The Matrix'?",
            "What is the largest ocean on Earth?",
            "Example 1",
            "Example 2"
        ),
        "answers" => array(
            array("Earth", "Mars", "Venus", "Jupiter", "Saturn"),
            array("Keanu Reeves", "Brad Pitt", "Tom Cruise", "Will Smith", "Johnny Depp"),
            array("Atlantic", "Indian", "Arctic", "Southern", "Pacific"),
            array("Wrong", "Wrong", "Right", "Wrong", "Wrong"),
            array("Wrong", "Wrong", "Wrong", "Wrong", "Right")
        ),
        "correct" => array(1, 0, 4, 2, 4),
        "points" => array(100, 200, 300, 400, 500)
    ),
    array(
        "questions" => array(
            "a",
            "b",
            "c",
            "d",
            "e"
        ),
        "answers" => array(
            array("0a", "1a", "2a", "3a", "4a"),
            array("0b", "1b", "2b", "3b", "4b"),
            array("0c", "1c", "2c", "3c", "4c"),
            array("0d", "1d", "2d", "3d", "4d"),
            array("0e", "1e", "2e", "3e", "4e")
        ),
        "correct" => array(1, 0, 4, 2, 4),
        "points" => array(100, 200, 300, 400, 500)
    )
);
?>
