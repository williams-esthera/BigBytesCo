
<?php 
// For creating and testing data
// WILL RESET DATA

$servername = "172.17.0.2:3306";
$username = "root";
$password = "password";
$databaseName = "property";

$connection = new mysqli($servername, $username, $password, $databaseName);

if($connection -> connect_error) {
    die("Connection failed: " . $connection -> connect_error);
}
error_log("Connection successful");

function runQuery($query) {
    global $connection;
    $results = $connection -> query($query);
    echo $query . "<br>";
    error_log($query);
    return $results;
}

// Remove tables if it exists(ensures that every refresh, it will clear out the database for testing purposes)
runQuery("DROP TABLE IF EXISTS WISHLISTS");
runQuery("DROP TABLE IF EXISTS PROPERTIES");

// Define schemas

$propertySchema = "
CREATE TABLE PROPERTIES (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL
)";

$wishlistSchema = "
CREATE TABLE WISHLISTS (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    user_id INT NOT NULL,

    FOREIGN KEY(property_id) REFERENCES PROPERTIES(property_id)
)";

// Create tables
runQuery($propertySchema);
runQuery($wishlistSchema);

// Insert queries(testing)
runQuery("
INSERT INTO PROPERTIES (address)
VALUES ('144 testing street');
");

runQuery("
INSERT INTO PROPERTIES (address)
VALUES ('36 apple pies');
");

runQuery("
INSERT INTO WISHLISTS (property_id, user_id)
VALUES ('1', '1');
");

runQuery("
INSERT INTO WISHLISTS (property_id, user_id)
VALUES ('2', '1');
");

echo "<br>Successfully reset data and initiated data!";
?>