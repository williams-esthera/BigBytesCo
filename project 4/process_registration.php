<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration processing</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php 
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Your existing code for processing the form data
        } else {
            echo "Invalid request method.";
        }


        // define("DB_NAME","ewilliams153");
        // define("DB_USER","ewilliams153");
        // define("DB_PASSWORD","ewilliams153");
        // define("DB_HOST","localhost");
        define("DB_NAME","property");
        define("DB_USER","root");
        define("DB_PASSWORD","password");
        define("DB_HOST","172.17.0.2");

        $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $username = $_POST["email"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];

        //encrypt password
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the 'accounts' table exists
    $table_exists_query = "SHOW TABLES LIKE 'accounts'";
    $result = mysqli_query($conn, $table_exists_query);

    if (mysqli_num_rows($result) > 0) {
        // If the 'accounts' table exists, insert data
        $sql = "INSERT INTO accounts (username, pass, firstName, lastName) VALUES ('$username','$encrypted_password','$fname','$lname')";
        echo "Checking if 'accounts' table exists.";
        if (mysqli_query($conn, $sql)) {
            session_start();
            /*$_SESSION["user_id"]=$username;*/
            header("Location: login.html");
             exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // If 'accounts' table does not exist, create table and insert data
        $create_table_query = "CREATE TABLE IF NOT EXISTS accounts ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(30) NOT NULL,
            pass VARCHAR(255) NOT NULL,
            firstName  VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL)";

        if (mysqli_query($conn, $create_table_query)) {
            echo  "Table accounts created successfully.";

            $sql = "INSERT INTO accounts (username, pass, firstName, lastName) VALUES ('$username','$encrypted_password','$fname','$lname')";

            if (mysqli_query($conn, $sql)) {
                session_start();
                /*$_SESSION["user_id"]=$username;*/
                header("Location: login.html");
                exit;
            } else {
                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    ?>

   <!-- <h1>Hello User <?php $username?> </h1>-->


</body>
</html>
