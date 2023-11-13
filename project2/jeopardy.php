<?php 

require_once(__DIR__.'/dependencies.php');

echo '<form method="post" action="selectedQuestion.php">';
echo '<table>';
echo '<tr>';
echo '<th></th>';

foreach (Category::cases() as $category) {
    $categoryName = $category == Category::GeneralKnowledge ? 'General Knowledge' : $category -> name;
    print '<th>' . $categoryName . '</th>';
}
echo '</tr>';

for($i = 0; $i < 5; $i++) {
    echo '<tr>';
    echo '<td><strong>' . ($i + 1) . '</strong></td>';
    for($j = 0; $j < count(Category::cases()); $j++) {
        echo '<td><button type="submit" name="questionNumber" value="' . 0 . '">$' . (100 + ($i * 100)) . '</button></td>';
    }
    echo '</tr>';
}

// for ($i = 0; $i < count($questions[0]["answers"]); $i++) {
//     echo '<tr>';
//     echo '<td><strong>' . ($i + 1) . '</strong></td>';
//     for ($j = 0; $j < count($categories); $j++) {
//         $questionNumber = ($j * 10) + ($i + 1);
//         echo '<td><button type="submit" name="q" value="' . $questionNumber . '">' . $questions[$j]["question"] . '</button></td>';
//     }
//     echo '</tr>';
// }

echo '</table>';
echo '</form>';

?>