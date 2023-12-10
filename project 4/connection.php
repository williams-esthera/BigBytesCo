<?php 

// Config
$host = "172.17.0.2:3306";
$user = "root";
$pass = "password";
$dbname = "property";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getConnection() {
    global $conn;
    return $conn;
}

function runQuery($query) {
    global $conn;
    $results = mysqli_query($conn, $query);
    error_log($query);
    return $results;
}

?>