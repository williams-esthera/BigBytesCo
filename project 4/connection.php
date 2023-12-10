<?php 

// Config
$host = "localhost";
$user = "ewilliams153";
$pass = "ewilliams153";
$dbname = "ewilliams153";

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