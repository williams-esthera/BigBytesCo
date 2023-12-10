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


        require_once(__DIR__.'/connection.php');
        // Create Connection
        $conn = getConnection();

        $username = $_POST["email"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $userType = $_POST["user-type"];
        $phoneNumber = $_POST["phone_number"];
        // if empty create empty array
        $propertyTypesArray = $_POST["property_type"] ?? [];
        $companyID = $_POST["company_id"];

        $numOfTypes = count($propertyTypesArray);
        $propertyTypes = "";
        for($i = 0; $i < $numOfTypes; $i++){
            $propertyTypes = $propertyTypes . $propertyTypesArray[$i];
            if($i < ($numOfTypes - 1)){
                $propertyTypes = $propertyTypes . ",";
            }
        }
        //echo $userType;
        //echo $phoneNumber;
        //echo $companyID;
        //echo "propertyTypes:" . $propertyTypes . "<br>";
        //encrypt password
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the 'accounts' table exists
    $table_exists_query = "SHOW TABLES LIKE 'accounts'";
    $result = mysqli_query($conn, $table_exists_query);

   // $companyID = !empty($companyID) ? intval($companyID) : null;


    if (mysqli_num_rows($result) > 0) {
        // If the 'accounts' table exists, insert data
        $sql = "INSERT INTO accounts (username, pass, firstName, lastName, userType, phoneNumber, propertyType, companyID) VALUES ('$username','$encrypted_password','$fname','$lname','$userType','$phoneNumber','$propertyTypes', '$companyID')";

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
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(30) NOT NULL,
            pass VARCHAR(255) NOT NULL,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            userType VARCHAR(10) NOT NULL,
            phoneNumber VARCHAR(20) DEFAULT NULL,
            propertyType VARCHAR(100) DEFAULT NULL,
            companyID VARCHAR(20) DEFAULT NULL
        )";
        

        if (mysqli_query($conn, $create_table_query)) {
            echo  "Table accounts created successfully.";

            $sql = "INSERT INTO accounts (username, pass, firstName, lastName, userType, phoneNumber, propertyType, companyID) VALUES ('$username','$encrypted_password','$fname','$lname','$userType','$phoneNumber','$propertyTypes', '$companyID')";

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
