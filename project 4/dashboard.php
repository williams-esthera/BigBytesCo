
<?php
session_start();
$user_id = $_SESSION["user_id"];
echo "<h2>Welcome: $user_id</h2>" ;
echo "<a href='./wishlist.php'>Wishlist</a>"
?>

