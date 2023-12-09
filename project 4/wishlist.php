<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Wishlist</title>
    <link rel ="stylesheet" href = "wishlist.css"/>
</head>

<body>
    <?php 
    // Connection setup
    session_start();
    define("DB_NAME","property");
    define("DB_USER","root");
    define("DB_PASSWORD","password");
    define("DB_HOST","172.17.0.2");
    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    // Runs query and logs it
    function runQuery($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        error_log($query);
        return $result;
    }
    ?>

    <div class="wishlist-container">
        <h1>Your wishlist</h1>

        <?php 
        // Fetches user id
        $username = $_SESSION["user_id"];
        $userQuery = runQuery("SELECT username, id FROM accounts WHERE username = '$username';");
        $userData = $userQuery -> fetch_assoc();
        error_log(implode(", ", $userData));

        // Uses user id to fetch their wishlist
        $userId = $userData['id'];
        $wishlistQuery = runQuery("SELECT * FROM WISHLISTS WHERE user_id = '$userId';");

        $propertyIdToRemove = $_POST['propertyId'];
        if($propertyIdToRemove != NULL) {
            
            runQuery("
            DELETE FROM WISHLISTS WHERE property_id = '$propertyIdToRemove' AND user_id = '$userId';
            ");
            echo "Successfully removed property id " . $propertyIdToRemove . " from wishlist.";
        }

        echo "<div class='properties'>";
        // Loops through wishlist
        if ($wishlistQuery -> num_rows > 0) {   
            while($row = $wishlistQuery -> fetch_assoc()) {
                // For each property in wishlist, runs a query to fetch its info
                $propertyId = $row['property_id'];
                if($propertyIdToRemove == $propertyId) { continue; }

                $propertyQuery = runQuery("SELECT * FROM PROPERTIES where property_id = '$propertyId'");
                $propertyData = $propertyQuery -> fetch_assoc();
                $address = $propertyData['address'];

                // Display it
                echo "<div class='property'>";
                echo "<div>Id: $propertyId</div>";
                echo "<div>Address: $address</div>";

                // Calls post request to self to remove from wishlist
                echo "<form method='post' action='./wishlist.php'>";
                echo "<input type='hidden' value='$propertyId' name='propertyId' />";
                echo "<button type='submit'>Remove</button>";
                echo "</form>";

                echo "</div>";
            }
        }
        echo "</div>";
        ?>
        
    </div>
</body>

</html>
