<?php 
// Replace servername with your MySql url
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
    
    error_log($query);
    return $results;
}

// Remove tables if it exists(ensures that every refresh, it will clear out the database for testing purposes)
runQuery("DROP TABLE IF EXISTS WISHLISTS");
runQuery("DROP TABLE IF EXISTS PROPERTIES");
runQuery("DROP TABLE IF EXISTS USERS");

// Define schemas
$userSchema = "
CREATE TABLE USERS (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

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

    FOREIGN KEY(property_id) REFERENCES PROPERTIES(property_id),
    FOREIGN KEY(user_id) REFERENCES USERS(user_id)
)";

// Create tables
runQuery($userSchema);
runQuery($propertySchema);
runQuery($wishlistSchema);

// Insert queries(testing)
runQuery("
INSERT INTO PROPERTIES (address)
VALUES ('144 testing street');
");

runQuery("
INSERT INTO USERS (username, password)
VALUES ('test', 'test');
");

runQuery("
INSERT INTO USERS (username, password)
VALUES ('test1', 'test1');
");
  
// $connection -> close();
?>